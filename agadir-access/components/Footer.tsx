import React from 'react';
import { Facebook, Twitter, Instagram, Globe, Heart, ShieldCheck } from 'lucide-react';

export const Footer: React.FC = () => {
  return (
    <footer className="bg-[#2A211D] text-white pt-16 pb-8">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
          {/* Brand */}
          <div className="space-y-4">
            <div className="flex items-center gap-2">
              <div className="w-8 h-8 bg-[#E76F51] rounded-lg flex items-center justify-center text-white font-bold">A</div>
              <span className="text-xl font-black tracking-tighter text-[#FFFBF0]">AgadirAccess</span>
            </div>
            <p className="text-orange-100/60 text-sm leading-relaxed">
              La première plateforme inclusive dédiée à l'accessibilité de la ville d'Agadir. Inspirée par la chaleur du soleil et l'hospitalité marocaine.
            </p>
          </div>

          {/* Navigation */}
          <div>
            <h4 className="font-bold text-[#F4A261] uppercase tracking-widest text-xs mb-6">Plateforme</h4>
            <ul className="space-y-3 text-sm font-medium text-orange-50/80">
              <li><a href="#" className="hover:text-[#F4A261] transition-colors">Explorer la carte</a></li>
              <li><a href="#" className="hover:text-[#F4A261] transition-colors">Calcul d'itinéraire</a></li>
              <li><a href="#" className="hover:text-[#F4A261] transition-colors">Signaler un obstacle</a></li>
              <li><a href="#" className="hover:text-[#F4A261] transition-colors">Lieux accessibles</a></li>
            </ul>
          </div>

          {/* Legal */}
          <div>
            <h4 className="font-bold text-[#F4A261] uppercase tracking-widest text-xs mb-6">Informations</h4>
            <ul className="space-y-3 text-sm font-medium text-orange-50/80">
              <li><a href="#" className="hover:text-[#F4A261] transition-colors">Accessibilité numérique</a></li>
              <li><a href="#" className="hover:text-[#F4A261] transition-colors">Mentions légales</a></li>
              <li><a href="#" className="hover:text-[#F4A261] transition-colors">Protection des données</a></li>
              <li><a href="#" className="hover:text-[#F4A261] transition-colors">Nous contacter</a></li>
            </ul>
          </div>

          {/* Social */}
          <div className="space-y-6">
            <h4 className="font-bold text-[#F4A261] uppercase tracking-widest text-xs mb-2">Suivez-nous</h4>
            <div className="flex gap-4">
              <SocialIcon icon={<Facebook size={18} />} />
              <SocialIcon icon={<Twitter size={18} />} />
              <SocialIcon icon={<Instagram size={18} />} />
              <SocialIcon icon={<Globe size={18} />} />
            </div>
            <div className="bg-white/5 backdrop-blur-md p-4 rounded-2xl flex items-center gap-3 border border-white/10">
              <ShieldCheck className="text-orange-400" size={24} />
              <div className="text-[10px]">
                <p className="font-bold text-[#FFFBF0] uppercase tracking-wider">Conformité WCAG 2.1</p>
                <p className="text-orange-100/40">Certifié AAA pour l'inclusion</p>
              </div>
            </div>
          </div>
        </div>

        <div className="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-bold text-orange-100/30 uppercase tracking-widest">
          <p>© 2026 AgadirAccess — Made with <Heart size={10} className="inline text-[#E76F51]" /> in Morocco</p>
          <div className="flex gap-8">
            <a href="#" className="hover:text-white">Plan du site</a>
            <a href="#" className="hover:text-white">Accessibilité</a>
          </div>
        </div>
      </div>
    </footer>
  );
};

const SocialIcon: React.FC<{ icon: React.ReactNode }> = ({ icon }) => (
  <a href="#" className="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-orange-100/60 hover:bg-[#E76F51] hover:text-white transition-all transform hover:-translate-y-1 border border-white/5">
    {icon}
  </a>
);
