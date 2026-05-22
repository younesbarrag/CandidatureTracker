import React, { createContext, useContext, useState, useEffect } from 'react';

type AccessibilityContextType = {
  fontSize: number;
  highContrast: boolean;
  language: 'fr' | 'ar' | 'en';
  setFontSize: (size: number) => void;
  toggleHighContrast: () => void;
  setLanguage: (lang: 'fr' | 'ar' | 'en') => void;
};

const AccessibilityContext = createContext<AccessibilityContextType | undefined>(undefined);

export const AccessibilityProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [fontSize, setFontSize] = useState(16);
  const [highContrast, setHighContrast] = useState(false);
  const [language, setLanguage] = useState<'fr' | 'ar' | 'en'>('fr');

  useEffect(() => {
    document.documentElement.style.fontSize = `${fontSize}px`;
    if (highContrast) {
      document.documentElement.classList.add('high-contrast');
    } else {
      document.documentElement.classList.remove('high-contrast');
    }
  }, [fontSize, highContrast]);

  return (
    <AccessibilityContext.Provider value={{ fontSize, highContrast, language, setFontSize, toggleHighContrast: () => setHighContrast(!highContrast), setLanguage }}>
      {children}
    </AccessibilityContext.Provider>
  );
};

export const useAccessibility = () => {
  const context = useContext(AccessibilityContext);
  if (!context) throw new Error('useAccessibility must be used within AccessibilityProvider');
  return context;
};
