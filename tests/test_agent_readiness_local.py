import json
import os
import re
import ssl
import unittest
import urllib.error
import urllib.request
from html.parser import HTMLParser

BASE_URL = os.environ.get("EMPC_BASE_URL", "https://empc-freelance.local").rstrip("/")
SSL_CTX = ssl._create_unverified_context()

SERVICE_PATHS = [
    "/diseno-web-leon/",
    "/tiendas-online-leon/",
    "/mantenimiento-wordpress-leon/",
    "/consultor-wordpress/",
    "/reparacion-wordpress-leon/",
    "/redaccion-contenidos-web-leon/",
]

EMPTY_TYPE_PATHS = [
    "/mantenimiento-wordpress-leon/",
    "/freelance-diseno-tienda-online-leon/",
    "/tienda-online-para-pequenos-negocios/",
    "/tienda-online-con-tienda-fisica/",
    "/xmlrpc-php-de-wordpress/",
    "/404-pagina-algo-no-esta/",
]

LEGACY_EMPTY_PAGE_PATHS = [
    "/activate/",
    "/dashboard/",
    "/forums/",
    "/groups/",
    "/members/",
    "/moderation/",
    "/news-feed/",
    "/photos/",
    "/privacy-policy/",
    "/register/",
    "/registrar-en-plataforma/",
    "/terms-of-service/",
]


class JsonLdParser(HTMLParser):
    def __init__(self):
        super().__init__()
        self.in_json_ld = False
        self.current = []
        self.blocks = []

    def handle_starttag(self, tag, attrs):
        attrs_dict = dict(attrs)
        if tag == "script" and attrs_dict.get("type") == "application/ld+json":
            self.in_json_ld = True
            self.current = []

    def handle_data(self, data):
        if self.in_json_ld:
            self.current.append(data)

    def handle_endtag(self, tag):
        if tag == "script" and self.in_json_ld:
            self.blocks.append("".join(self.current))
            self.in_json_ld = False


def fetch(path):
    req = urllib.request.Request(
        f"{BASE_URL}{path}", headers={"User-Agent": "AgentReadinessTester/1.0"}
    )
    try:
        with urllib.request.urlopen(req, context=SSL_CTX) as response:
            return response.status, dict(response.headers), response.read().decode("utf-8", errors="ignore")
    except urllib.error.HTTPError as error:
        return error.code, dict(error.headers), error.read().decode("utf-8", errors="ignore")


def json_ld_nodes(html):
    parser = JsonLdParser()
    parser.feed(html)
    nodes = []
    for block in parser.blocks:
        payload = json.loads(block)
        nodes.extend(payload.get("@graph", [payload]) if isinstance(payload, dict) else payload)
    return [node for node in nodes if isinstance(node, dict)]


def type_names(node):
    value = node.get("@type", [])
    return {value} if isinstance(value, str) else set(value)


class TestAgentReadinessLocal(unittest.TestCase):
    def test_llms_txt_is_curated_plain_text(self):
        status, headers, body = fetch("/llms.txt")
        self.assertEqual(status, 200)
        self.assertTrue(headers.get("Content-Type", "").startswith("text/plain"))
        self.assertIn("# EMPC", body)
        self.assertIn("## Servicios", body)
        self.assertIn("https://empc.es/contacta-conmigo/", body)
        self.assertNotIn("Agent Ready", body)
        self.assertNotIn("MCP", body)
        self.assertNotIn("tel:", body.lower())

    def test_known_routes_have_no_empty_or_duplicate_schema_nodes(self):
        for path in EMPTY_TYPE_PATHS:
            with self.subTest(path=path):
                status, _, body = fetch(path)
                self.assertEqual(status, 200)
                nodes = json_ld_nodes(body)
                self.assertTrue(nodes)
                self.assertFalse(any(node.get("@type") == "" for node in nodes))
                ids = [str(node["@id"]) for node in nodes if node.get("@id")]
                duplicates = sorted({node_id for node_id in ids if ids.count(node_id) > 1})
                self.assertFalse(duplicates, f"Duplicate schema @id on {path}: {duplicates}")

    def test_service_main_entity_references_resolve(self):
        for path in SERVICE_PATHS:
            with self.subTest(path=path):
                status, _, body = fetch(path)
                self.assertEqual(status, 200)
                nodes = json_ld_nodes(body)
                ids = {node.get("@id") for node in nodes if node.get("@id")}
                services = [node for node in nodes if "Service" in type_names(node)]
                self.assertTrue(services, f"{path} must define Service")
                self.assertTrue(any("WebPage" in type_names(node) for node in nodes))
                for service in services:
                    target = service.get("mainEntityOfPage", {}).get("@id")
                    self.assertIn(target, ids, f"Unresolved mainEntityOfPage on {path}: {target}")
                    self.assertRegex(target, r"/#webpage$")

    def test_legacy_empty_pages_are_noindex(self):
        for path in LEGACY_EMPTY_PAGE_PATHS:
            with self.subTest(path=path):
                status, _, body = fetch(path)
                self.assertEqual(status, 200)
                robots = re.findall(
                    r'<meta[^>]+name=["\']robots["\'][^>]+content=["\']([^"\']+)',
                    body,
                    flags=re.I,
                )
                self.assertTrue(robots, f"Missing robots meta on {path}")
                self.assertIn("noindex", robots[0].lower())


if __name__ == "__main__":
    unittest.main()
