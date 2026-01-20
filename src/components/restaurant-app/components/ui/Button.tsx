import React from 'react';

interface ButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  variant?: 'primary' | 'secondary' | 'outline' | 'ghost';
  fullWidth?: boolean;
}

const Button: React.FC<ButtonProps> = ({ 
  children, 
  variant = 'primary', 
  fullWidth = false, 
  className = '',
  ...props 
}) => {
  const baseStyles = "inline-flex items-center justify-center px-6 py-3 border text-base font-medium rounded-2xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transform active:scale-[0.98]";
  
  const variants = {
    primary: "border-transparent text-white bg-brand-600 hover:bg-brand-700 focus:ring-brand-500 shadow-lg shadow-brand-500/30",
    secondary: "border-transparent text-brand-700 bg-brand-100 hover:bg-brand-200 focus:ring-brand-500",
    outline: "border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:ring-brand-500",
    ghost: "border-transparent text-gray-600 hover:bg-gray-100 hover:text-gray-900 focus:ring-gray-500"
  };

  return (
    <button 
      className={`${baseStyles} ${variants[variant]} ${fullWidth ? 'w-full' : ''} ${className}`}
      {...props}
    >
      {children}
    </button>
  );
};

export default Button;