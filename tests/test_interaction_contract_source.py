import pathlib
import unittest

ROOT = pathlib.Path(__file__).resolve().parents[1]


class TestInteractionContractSource(unittest.TestCase):
    def read(self, relative):
        return (ROOT / relative).read_text(encoding="utf-8")

    def test_contact_form_requires_explicit_privacy_consent(self):
        source = self.read("src/components/ContactForm.tsx")
        self.assertIn("consent: false", source)
        self.assertIn('name="consent"', source)
        self.assertIn('id="cf-consent"', source)
        self.assertIn("required", source)
        self.assertIn("/politica-de-privacidad/", source)

    def test_contact_form_exposes_labels_and_live_status(self):
        source = self.read("src/components/ContactForm.tsx")
        self.assertIn('htmlFor="cf-message"', source)
        self.assertIn('id="cf-message"', source)
        self.assertIn('role="alert"', source)
        self.assertIn('aria-live="polite"', source)
        self.assertNotIn("Gracias, Emma.", source)

    def test_service_cta_form_has_bound_labels_and_consent(self):
        source = self.read("src/components/services/CTAForm.tsx")
        for field_id in ["cta-nombre", "cta-email", "cta-telefono", "cta-tipo", "cta-mensaje", "cta-presupuesto"]:
            self.assertIn(f'id="{field_id}"', source)
            self.assertIn(f'htmlFor="{field_id}"', source)
        self.assertIn("consent: false", source)
        self.assertIn('id="cta-consent"', source)
        self.assertIn('role="status"', source)
        self.assertIn('role="alert"', source)
        self.assertNotIn("Respuesta garantizada", source)

    def test_pricing_calculator_names_controls_and_result(self):
        source = self.read("src/components/PricingCalculator.tsx")
        self.assertIn('htmlFor="maintenance-plan"', source)
        self.assertIn('id="maintenance-plan"', source)
        self.assertIn('aria-live="polite"', source)
        self.assertIn('aria-label="Quitar una página adicional"', source)
        self.assertIn('aria-label="Añadir una página adicional"', source)

    def test_budget_calculator_names_stepper_controls(self):
        source = self.read("src/components/BudgetCalculator.tsx")
        self.assertIn('aria-label="Quitar una página adicional"', source)
        self.assertIn('aria-label="Añadir una página adicional"', source)
        self.assertIn('aria-live="polite"', source)

    def test_demo_flows_do_not_claim_real_operations(self):
        booking = self.read("src/components/islands/booking/BookingIsland.tsx")
        booking += self.read("src/components/islands/booking/components/CustomerForm.tsx")
        booking += self.read("src/islands/booking/components/CustomerForm.tsx")
        restaurant = self.read("src/components/restaurant-app/components/StepSummary.tsx")
        ecommerce = self.read("src/components/services/EcommerceCTAForm.tsx")
        self.assertIn("Demostración", booking)
        self.assertIn("no crea una reserva", booking)
        self.assertNotIn("¡Mesa Reservada!", restaurant)
        self.assertNotIn("¡Pedido Recibido!", restaurant)
        self.assertIn("ninguna reserva o pedido", restaurant)
        self.assertNotIn("Confirmar Reserva", booking + restaurant)
        self.assertNotIn("Pagar y Pedir", restaurant)
        self.assertNotIn("¡Mensaje recibido!", ecommerce)
        self.assertIn("No se ha enviado ningún mensaje", ecommerce)
        self.assertNotIn("console.log('Form submitted:'", ecommerce)

    def test_php_schema_uses_one_webpage_identifier_shape(self):
        source = self.read("inc/seo-social-schema.php")
        self.assertNotIn("rtrim($canonical, '/') . '#webpage'", source)
        self.assertIn("trailingslashit($canonical) . '#webpage'", source)

    def test_contact_endpoint_requires_consent_and_rate_limits_by_ip(self):
        source = self.read("functions.php")
        self.assertIn("empc_has_valid_consent", source)
        self.assertNotIn("HTTP_USER_AGENT", source)
        self.assertIn("'consent' => [", source)
        self.assertIn("'required' => true", source)


if __name__ == "__main__":
    unittest.main()
