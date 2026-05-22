import React from 'react';
import { AccessibilityProvider } from './context/AccessibilityContext';
import { Navbar } from './components/Navbar';
import { Footer } from './components/Footer';

export const Layout: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  return (
    <AccessibilityProvider>
      <div className="flex flex-col min-h-screen">
        <Navbar />
        <main className="flex-1">
          {children}
        </main>
        <Footer />
      </div>
    </AccessibilityProvider>
  );
};
