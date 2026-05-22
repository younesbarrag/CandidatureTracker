import React from 'react';
import { MapPin, Navigation, Accessibility, Footprints, Eye, Volume2, ArrowRight, Clock, ShieldCheck, ChevronDown, Sun } from 'lucide-react';

export const RouteAssistantPage: React.FC = () => {
  return (
    <div className="bg-[#FFFBF0] min-h-screen">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        <div className="text-center space-y-4">
          <div className="inline-flex items-center gap-2 bg-[#E76F51] text-white px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest shadow-lg shadow-orange-200">
            <Sun size={16} /> Assistant Saffron
          </div>
          <h1 className="text-5xl font-black text-[#2A211D] tracking-tight">Calcul d'Itinéraire Inclusif</h1>
          <p className="text-xl text-orange-900/60 font-medium leading-relaxed">L'IA d'AgadirAccess analyse le terrain pour vous proposer le chemin le plus chaleureux et accessible.</p>
        </div>

        {/* Route Form */}
        <section className="bg-white rounded-[3rem] p-10 shadow-premium border border-orange-50 space-y-10">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div className="space-y-2">
              <label className="text-[10px] font-black text-orange-900/40 uppercase tracking-widest ml-4">Départ</label>
              <div className="relative">
                <MapPin className="absolute left-4 top-4 text-[#E76F51]" size={20} />
                <input 
                  type="text" 
                  placeholder="Ma position actuelle" 
                  className="w-full pl-12 pr-4 py-4 bg-orange-50/30 border-none rounded-2xl focus:ring-2 focus:ring-[#E76F51] outline-none font-bold text-[#2A211D]"
                />
              </div>
            </div>
            <div className="space-y-2">
              <label className="text-[10px] font-black text-orange-900/40 uppercase tracking-widest ml-4">Destination</label>
              <div className="relative">
                <Navigation className="absolute left-4 top-4 text-[#F4A261]" size={20} />
                <input 
                  type="text" 
                  placeholder="Où voulez-vous aller ?" 
                  className="w-full pl-12 pr-4 py-4 bg-orange-50/30 border-none rounded-2xl focus:ring-2 focus:ring-[#E76F51] outline-none font-bold text-[#2A211D]"
                />
              </div>
            </div>
          </div>

          <div className="space-y-6">
            <label className="text-[10px] font-black text-orange-900/40 uppercase tracking-widest ml-4">Mes besoins spécifiques</label>
            <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
              <NeedsButton icon={<Footprints size={20} />} label="Fauteuil" active />
              <NeedsButton icon={<Eye size={20} />} label="Vision" />
              <NeedsButton icon={<Volume2 size={20} />} label="Audition" />
              <NeedsButton icon={<Accessibility size={20} />} label="Senior" />
            </div>
          </div>

          <button className="w-full bg-[#2A211D] text-white py-5 rounded-[2rem] font-black text-xl hover:bg-black transition-all shadow-xl shadow-slate-200 flex items-center justify-center gap-3">
            Calculer l'Itinéraire Doré
            <ArrowRight size={24} />
          </button>
        </section>

        {/* Results Preview */}
        <section className="space-y-6 animate-in fade-in slide-in-from-bottom-10 duration-700">
          <div className="flex items-center justify-between px-4">
             <h2 className="text-xl font-black text-[#2A211D]">Meilleur Itinéraire Trouvé</h2>
             <span className="bg-orange-100 text-[#E76F51] px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">Saffron Recommendé</span>
          </div>
          
          <div className="bg-white rounded-[2.5rem] overflow-hidden border border-orange-100 shadow-premium">
            <div className="p-8 space-y-8">
              <div className="flex items-center gap-8">
                <div className="flex flex-col items-center gap-1">
                  <div className="w-4 h-4 rounded-full bg-[#E76F51] ring-4 ring-orange-50" />
                  <div className="w-0.5 h-12 bg-orange-50" />
                  <div className="w-4 h-4 rounded-full bg-[#F4A261] ring-4 ring-orange-50" />
                </div>
                <div className="space-y-8 flex-1">
                  <div>
                    <p className="text-sm font-black text-[#2A211D]">Point de départ</p>
                    <p className="text-xs text-orange-900/40 font-bold uppercase tracking-widest">Place Al Amal</p>
                  </div>
                  <div>
                    <p className="text-sm font-black text-[#2A211D]">Marina d'Agadir</p>
                    <p className="text-xs text-orange-900/40 font-bold uppercase tracking-widest">Arrivée estimée à 14:45</p>
                  </div>
                </div>
                <div className="text-right">
                  <p className="text-2xl font-black text-[#E76F51]">12 min</p>
                  <p className="text-xs font-bold text-orange-900/40 uppercase tracking-widest">850 mètres</p>
                </div>
              </div>

              <div className="pt-8 border-t border-orange-50 grid grid-cols-1 md:grid-cols-3 gap-4">
                 <RouteStep icon={<ShieldCheck className="text-emerald-500" size={18} />} label="100% Trottoirs larges" />
                 <RouteStep icon={<Clock className="text-[#E76F51]" size={18} />} label="Pas de zones de travaux" />
                 <RouteStep icon={<Accessibility className="text-[#F4A261]" size={18} />} label="3 Passages PMR" />
              </div>
            </div>
            
            <div className="bg-orange-50/30 p-4 text-center">
               <button className="text-[#E76F51] font-black text-sm flex items-center gap-2 mx-auto hover:bg-white px-4 py-2 rounded-xl transition-all">
                 Afficher les détails de navigation <ChevronDown size={18} />
               </button>
            </div>
          </div>
        </section>
      </div>
    </div>
  );
};

const NeedsButton: React.FC<{ icon: React.ReactNode; label: string; active?: boolean }> = ({ icon, label, active }) => (
  <button className={`flex flex-col items-center justify-center gap-3 p-6 rounded-[2rem] border-2 transition-all ${
    active 
      ? 'bg-orange-50 border-[#E76F51] text-[#E76F51] shadow-lg shadow-orange-100' 
      : 'bg-white border-orange-50 text-orange-900/40 hover:border-orange-200 hover:text-orange-900/60'
  }`}>
    <div className={`w-12 h-12 rounded-2xl flex items-center justify-center ${active ? 'bg-[#E76F51] text-white' : 'bg-orange-50'}`}>
      {icon}
    </div>
    <span className="text-xs font-black uppercase tracking-widest">{label}</span>
  </button>
);

const RouteStep: React.FC<{ icon: React.ReactNode; label: string }> = ({ icon, label }) => (
  <div className="flex items-center gap-3 bg-orange-50/50 p-4 rounded-2xl">
    {icon}
    <span className="text-[10px] font-black text-orange-900/60 uppercase tracking-widest">{label}</span>
  </div>
);
