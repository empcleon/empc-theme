import React from 'react';
import { StepProps, MenuItem } from '../types';
import { MENU_ITEMS } from '../constants';
import Button from './ui/Button';
import { Plus, Minus, ShoppingBag } from 'lucide-react';

const StepMenu: React.FC<StepProps> = ({ bookingData, updateBooking, onNext, onBack }) => {
  
  const handleQuantity = (item: MenuItem, delta: number) => {
    const currentCart = [...bookingData.cart];
    const existingIndex = currentCart.findIndex(i => i.id === item.id);

    if (existingIndex >= 0) {
      const newQty = currentCart[existingIndex].quantity + delta;
      if (newQty <= 0) {
        currentCart.splice(existingIndex, 1);
      } else {
        currentCart[existingIndex].quantity = newQty;
      }
    } else if (delta > 0) {
      currentCart.push({ ...item, quantity: 1 });
    }

    updateBooking({ cart: currentCart });
  };

  const getItemQty = (id: string) => bookingData.cart.find(i => i.id === id)?.quantity || 0;
  const cartTotal = bookingData.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

  const categories = {
      tapas: 'Para Picar',
      main: 'Principales',
      drinks: 'Bebida'
  };

  return (
    <div className="space-y-6 fade-in h-[500px] flex flex-col">
      <div className="text-center flex-shrink-0">
        <h2 className="text-2xl font-display font-bold text-gray-900">Nuestra Carta</h2>
        <p className="text-gray-500 mt-1">Sabores de León directo a tu casa.</p>
      </div>

      <div className="flex-1 overflow-y-auto pr-2 space-y-6 scrollbar-thin scrollbar-thumb-gray-200">
        {(Object.keys(categories) as Array<keyof typeof categories>).map(catKey => (
            <div key={catKey}>
                <h3 className="font-bold text-gray-800 text-lg sticky top-0 bg-white py-2 z-10 border-b border-gray-100 mb-3">
                    {categories[catKey]}
                </h3>
                <div className="grid gap-4">
                    {MENU_ITEMS.filter(i => i.category === catKey).map(item => {
                        const qty = getItemQty(item.id);
                        return (
                            <div key={item.id} className="flex gap-4 p-3 rounded-2xl border border-gray-100 hover:border-emerald-100 transition-colors bg-white">
                                <div className="text-4xl bg-gray-50 w-20 h-20 flex items-center justify-center rounded-xl flex-shrink-0">
                                    {item.image}
                                </div>
                                <div className="flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 className="font-bold text-gray-900">{item.title}</h4>
                                        <p className="text-xs text-gray-500 line-clamp-2">{item.description}</p>
                                    </div>
                                    <div className="flex items-center justify-between mt-2">
                                        <span className="font-bold text-emerald-700">{item.price.toFixed(2)}€</span>
                                        <div className="flex items-center gap-3 bg-gray-50 rounded-lg p-1">
                                            <button 
                                                onClick={() => handleQuantity(item, -1)}
                                                disabled={qty === 0}
                                                className="w-7 h-7 flex items-center justify-center rounded-md bg-white shadow-sm disabled:opacity-50 text-emerald-600 hover:bg-emerald-50"
                                            >
                                                <Minus size={14} />
                                            </button>
                                            <span className="text-sm font-bold w-4 text-center">{qty}</span>
                                            <button 
                                                onClick={() => handleQuantity(item, 1)}
                                                className="w-7 h-7 flex items-center justify-center rounded-md bg-white shadow-sm text-emerald-600 hover:bg-emerald-50"
                                            >
                                                <Plus size={14} />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        )
                    })}
                </div>
            </div>
        ))}
      </div>

      {/* Floating Cart Footer */}
      <div className="border-t border-gray-100 pt-4 bg-white flex-shrink-0">
         <div className="flex justify-between items-center mb-4 px-2">
             <span className="text-sm text-gray-500">{bookingData.cart.reduce((a,b) => a+b.quantity, 0)} productos</span>
             <span className="text-xl font-bold text-gray-900">Total: {cartTotal.toFixed(2)}€</span>
         </div>
         <div className="flex gap-3">
             <Button variant="ghost" onClick={onBack} className="w-1/3">Atrás</Button>
             <Button 
                onClick={onNext} 
                fullWidth 
                className="flex-1"
                disabled={bookingData.cart.length === 0}
            >
                 <ShoppingBag size={18} className="mr-2"/>
                 Finalizar Pedido
             </Button>
         </div>
      </div>
    </div>
  );
};

export default StepMenu;