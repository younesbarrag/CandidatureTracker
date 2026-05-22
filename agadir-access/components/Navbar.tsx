import React from 'react';
import { useAccessibility } from '../context/AccessibilityContext';
import { Sun, Moon, Type, Languages, Search, MapPin, Route, AlertTriangle, Menu, X } from 'lucide-react';

export const Navbar: React.FC = () => {
  const { fontSize, setFontSize, highContrast, toggleHighContrast, language, setLanguage } = useAccessibility();
  const [isMenuOpen, setIsMenuOpen] = React.useState(false);

  return (
    <nav className={`sticky top-0 z-50 w-full bg-[#FFFBF0]/80 backdrop-blur-xl border-b border-orange-100/60 transition-all ${highContrast ? 'bg-black text-white border-white' : ''}`}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-20">
          {/* Logo */}
          <div className="flex items-center gap-2 group cursor-pointer">
            <div className="w-10 h-10 bg-[#E76F51] rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-200 group-hover:rotate-12 transition-transform">
              <MapPin size={24} />
            </div>
            <div>
              <span className="text-xl font-black text-[#2A211D] tracking-tighter">AgadirAccess</span>
              <p className="text-[10px] font-bold text-[#E76F51] uppercase tracking-widest">Inclusion Sans Limite</p>
            </div>
          </div>

          {/* Desktop Navigation */}
          <div className="hidden md:flex items-center gap-8">
            <NavLink icon={<Search size={18} />} label="Explorer" active />
            <NavLink icon={<Route size={18} />} label="Itinéraire" />
            <NavLink icon={<AlertTriangle size={18} />} label="Signaler" />
          </div>

          {/* Accessibility Toolbar */}
          <div className="hidden md:flex items-center gap-4 pl-8 border-l border-orange-100">
            <div className="flex items-center bg-orange-50 rounded-full p-1 gap-1">
              <button 
                onClick={() => setFontSize(Math.max(12, fontSize - 2))}
                className="p-1.5 hover:bg-white rounded-full transition-colors text-orange-800"
                aria-label="Diminuer la taille du texte"
              >
                <Type size={16} />
              </button>
              <span className="text-xs font-bold px-1 text-orange-900">{fontSize}</span>
              <button 
                onClick={() => setFontSize(Math.min(24, fontSize + 2))}
                className="p-1.5 hover:bg-white rounded-full transition-colors text-orange-800"
                aria-label="Augmenter la taille du texte"
              >
                <Type size={20} />
              </button>
            </div>

            <button 
              onClick={toggleHighContrast}
              className={`p-2 rounded-full transition-all ${highContrast ? 'bg-white text-black' : 'bg-orange-50 text-orange-700 hover:bg-orange-100'}`}
              aria-label="Basculer le contraste élevé"
            >
              {highContrast ? <Sun size={20} /> : <Moon size={20} />}
            </button>

            <select 
              value={language} 
              onChange={(e) => setLanguage(e.target.value as any)}
              className="bg-orange-50 text-orange-900 text-sm font-bold rounded-full px-4 py-2 border-none outline-none focus:ring-2 focus:ring-[#E76F51]"
            >
              <option value="fr">FR</option>
              <option value="ar">AR</option>
              <option value="en">EN</option>
            </select>
          </div>

          {/* Mobile Menu Button */}
          <div className="md:hidden flex items-center gap-2">
            <button 
              onClick={() => setIsMenuOpen(!isMenuOpen)}
              className="p-2 text-[#2A211D]"
            >
              {isMenuOpen ? <X size={24} /> : <Menu size={24} />}
            </button>
          </div>
        </div>
      </div>

      {/* Mobile Menu */}
      {isMenuOpen && (
        <div className="md:hidden bg-[#FFFBF0] border-b border-orange-100 px-4 py-6 space-y-4 animate-in slide-in-from-top duration-300">
          <NavLink icon={<Search size={20} />} label="Explorer" mobile />
          <NavLink icon={<Route size={20} />} label="Itinéraire" mobile />
          <NavLink icon={<AlertTriangle size={20} />} label="Signaler" mobile />
        </div>
      )}
    </nav>
  );
};

const NavLink: React.FC<{ icon: React.ReactNode; label: string; active?: boolean; mobile?: boolean }> = ({ icon, label, active, mobile }) => (
  <a 
    href="#" 
    className={`flex items-center gap-2 font-bold transition-all ${
      active ? 'text-[#E76F51]' : 'text-orange-900/60 hover:text-[#2A211D]'
    } ${mobile ? 'text-lg py-2' : 'text-sm'}`}
  >
    <span className={active ? 'scale-110' : ''}>{icon}</span>
    {label}
  </a>
);
