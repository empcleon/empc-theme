/**
 * Mock Gemini Service - Para demo sin API key
 * 
 * TODO: Implementar con @google/genai cuando tengas la API key
 */

interface BusinessStrategy {
  wordpressStrategy: string;
  reactFeature: string;
  localSeoTip: string;
}

// Respuestas de ejemplo para la demo
const mockResponses: Record<string, BusinessStrategy> = {
  default: {
    wordpressStrategy: "Recomendamos un WordPress con tema personalizado, blog optimizado para SEO y sistema de gestión de contenidos fácil de usar para tu equipo.",
    reactFeature: "Desarrollaremos una aplicación interactiva de citas/reservas online que permita a tus clientes ver disponibilidad en tiempo real y reservar sin llamadas.",
    localSeoTip: "Optimiza tu ficha de Google My Business con fotos de calidad, responde a todas las reseñas y usa keywords locales como 'en León' en tus títulos."
  },
  panaderia: {
    wordpressStrategy: "Web WordPress con catálogo de productos, blog de recetas y sistema de pedidos anticipados integrado con WhatsApp Business.",
    reactFeature: "Configurador visual de tartas personalizadas donde el cliente puede elegir sabores, tamaños y decoraciones, viendo el precio en tiempo real.",
    localSeoTip: "Crea contenido sobre 'pan artesano León' y 'panadería tradicional' para posicionarte en búsquedas locales."
  },
  clinica: {
    wordpressStrategy: "Web WordPress profesional con información de servicios, equipo médico, y formulario de contacto RGPD compliant.",
    reactFeature: "Sistema de citas online con calendario de disponibilidad, recordatorios por email/SMS y gestión de historial de pacientes.",
    localSeoTip: "Incluye testimonios de pacientes y certificaciones. Usa keywords como 'dentista León' y 'clínica dental centro León'."
  },
  restaurante: {
    wordpressStrategy: "Web con carta digital, galería de platos, información de alérgenos y sistema de opiniones integrado.",
    reactFeature: "Sistema de reservas con selección de mesa visual, menú del día actualizable y carta interactiva con fotos.",
    localSeoTip: "Optimiza para 'restaurante León', añade tu carta a Google y responde a todas las reseñas de Google Maps."
  }
};

export const consultBusinessStrategy = async (
  businessType: string,
  _goals: string
): Promise<BusinessStrategy> => {
  // Simulamos un delay de red
  await new Promise(resolve => setTimeout(resolve, 1500));

  const businessLower = businessType.toLowerCase();

  // Buscar respuesta por tipo de negocio
  if (businessLower.includes('panad') || businessLower.includes('pan') || businessLower.includes('pastel')) {
    return mockResponses.panaderia;
  }
  if (businessLower.includes('clinic') || businessLower.includes('dental') || businessLower.includes('medic') || businessLower.includes('doctor')) {
    return mockResponses.clinica;
  }
  if (businessLower.includes('restaur') || businessLower.includes('bar') || businessLower.includes('cafeter')) {
    return mockResponses.restaurante;
  }

  // Respuesta por defecto personalizada
  return {
    wordpressStrategy: `Para tu ${businessType}, recomendamos un WordPress profesional con diseño personalizado, blog de contenidos relevantes y formularios de contacto optimizados para conversión.`,
    reactFeature: `Desarrollaremos una herramienta interactiva personalizada para ${businessType} que mejore la experiencia de usuario y facilite la conversión de visitantes en clientes.`,
    localSeoTip: `Optimiza tu presencia local incluyendo '${businessType} en León' en tus títulos y descripciones. Mantén actualizada tu ficha de Google My Business.`
  };
};