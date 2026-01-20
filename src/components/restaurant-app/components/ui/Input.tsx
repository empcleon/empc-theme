import React from 'react';

interface InputProps extends React.InputHTMLAttributes<HTMLInputElement> {
  label: string;
  error?: string;
}

const Input: React.FC<InputProps> = ({ label, error, className = '', ...props }) => {
  return (
    <div className={`flex flex-col space-y-1.5 ${className}`}>
      <label className="text-sm font-medium text-gray-700 pl-1">
        {label}
      </label>
      <input
        className={`
          block w-full px-4 py-3 rounded-2xl border bg-gray-50 
          text-gray-900 placeholder-gray-400
          focus:outline-none focus:ring-2 focus:ring-brand-500 focus:bg-white focus:border-transparent
          transition-colors duration-200
          ${error ? 'border-red-500 ring-red-200' : 'border-gray-200'}
        `}
        {...props}
      />
      {error && (
        <span className="text-xs text-red-500 pl-1">{error}</span>
      )}
    </div>
  );
};

export default Input;