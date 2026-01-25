// Script de prueba para verificar si React está funcionando
console.log('🔧 TESTING SCRIPT STARTED');

// Test 1: Verificar que el elemento root existe
const rootElement = document.getElementById('root');
console.log('🎯 Root element found:', !!rootElement, rootElement);

// Test 2: Inyectar contenido manualmente para probar que el div funciona
if (rootElement) {
    rootElement.innerHTML = `
        <div style="background: linear-gradient(45deg, #ef4444, #f97316); color: white; padding: 40px; text-align: center; border-radius: 10px; margin: 20px auto; max-width: 600px;">
            <h2>🎉 MANUAL INJECTION WORKS! 🎉</h2>
            <p>El div#root existe y puede recibir contenido.</p>
            <p>Si ves esto, el problema está en React mounting.</p>
        </div>
    `;
    console.log('✅ Manual injection successful');
} else {
    console.error('❌ Root element not found');
}

// Test 3: Verificar si hay errores de JavaScript
window.addEventListener('error', function(e) {
    console.error('💥 JavaScript error:', e.error);
});

window.addEventListener('unhandledrejection', function(e) {
    console.error('💥 Promise rejection:', e.reason);
});

console.log('🔧 TESTING SCRIPT COMPLETE');