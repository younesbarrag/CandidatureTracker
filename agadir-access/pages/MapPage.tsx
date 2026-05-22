import React from 'react';
import { Search, Filter, MapPin, Navigation, Info, ChevronRight, CheckCircle2, XCircle } from 'lucide-react';

export const MapPage: React.FC = () => {
  return (
    <div className="flex h-[calc(100vh-80px)] overflow-hidden bg-white">
      {/* Sidebar Filters */}
      <aside className="w-full md:w-[400px] border-r border-orange-100 flex flex-col bg-[#FFFBF0]">
        <div className="p-6 border-b border-orange-100 space-y-4">
          <div className="relative">
            <Search className="absolute left-3 top-3 text-orange-400" size={18} />
            <input 
              type="text" 
              placeholder="Rechercher un lieu..." 
              className="w-full pl-10 pr-4 py-3 bg-white border border-orange-100 rounded-xl focus:ring-2 focus:ring-[#E76F51] outline-none font-medium text-[#2A211D]"
            />
          </div>
          <div className="flex gap-2">
            <FilterButton label="Hôtels" active />
            <FilterButton label="Plages" />
            <FilterButton label="Santé" />
          </div>
        </div>

        <div className="flex-1 overflow-y-auto p-4 space-y-4">
          <p className="text-[10px] font-black text-orange-900/40 uppercase tracking-widest px-2">Résultats à proximité (12)</p>
          <PlaceCard 
            title="Marina d'Agadir" 
            category="Tourisme" 
            score={95} 
            status="Totalement Accessible" 
            img="https://images.unsplash.com/photo-1590001158193-790dc0ca007d?w=400"
          />
          <PlaceCard 
            title="Souk El Had" 
            category="Commerce" 
            score={65} 
            status="Partiellement Accessible" 
            img="https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=400"
          />
          <PlaceCard 
            title="Jardin de Olhão" 
            category="Parc" 
            score={88} 
            status="Accessible" 
            img="https://images.unsplash.com/photo-1467803738586-46b7eb7b16a1?w=400"
          />
        </div>
      </aside>

      {/* Map Container */}
      <main className="flex-1 relative bg-orange-50/20">
        {/* Mock Map UI */}
        <div className="absolute inset-0 bg-[url('https://api.mapbox.com/styles/v1/mapbox/light-v10/static/9.4981,30.4278,13,0/1280x800?access_token=mock')] bg-cover bg-center grayscale-[0.2] sepia-[0.1]">
          {/* Custom Markers */}
          <MapMarker top="40%" left="45%" color="bg-[#E76F51]" />
          <MapMarker top="55%" left="50%" color="bg-[#F4A261]" />
          <MapMarker top="30%" left="60%" color="bg-[#E76F51]" />
        </div>

        {/* Map Controls */}
        <div className="absolute top-6 right-6 flex flex-col gap-2">
          <MapControl icon={<Navigation size={20} />} />
          <MapControl icon={<Info size={20} />} />
        </div>

        {/* Floating Info Overlay */}
        <div className="absolute bottom-10 left-1/2 -translate-x-1/2 bg-white p-4 rounded-2xl shadow-premium border border-orange-100 flex items-center gap-4 animate-in slide-in-from-bottom-10">
          <div className="w-12 h-12 bg-[#2A211D] rounded-xl flex items-center justify-center text-[#F4A261]">
            <Navigation size={24} />
          </div>
          <div>
            <p className="text-sm font-black text-[#2A211D]">Itinéraire en cours</p>
            <p className="text-xs text-orange-900/40 font-bold uppercase tracking-widest">Marina d'Agadir · 12 min</p>
          </div>
          <button className="bg-orange-50 p-2 rounded-xl text-orange-600 hover:bg-orange-100">
            <XCircle size={20} />
          </button>
        </div>
      </main>
    </div>
  );
};

const FilterButton: React.FC<{ label: string; active?: boolean }> = ({ label, active }) => (
  <button className={`px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-wider transition-all ${
    active ? 'bg-[#E76F51] text-white shadow-lg shadow-orange-100' : 'bg-white text-orange-900/40 border border-orange-100 hover:border-[#E76F51] hover:text-[#E76F51]'
  }`}>
    {label}
  </button>
);

const PlaceCard: React.FC<{ title: string; category: string; score: number; status: string; img: string }> = ({ title, category, score, status, img }) => (
  <div className="bg-white p-4 rounded-2xl border border-orange-50 flex gap-4 hover:shadow-md transition-all cursor-pointer group">
    <div className="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0">
      <img src={img} alt={title} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
    </div>
    <div className="flex-1 min-w-0">
      <div className="flex justify-between items-start">
        <p className="text-[10px] font-black text-[#E76F51] uppercase tracking-widest">{category}</p>
        <span className={`text-[10px] font-black px-2 py-0.5 rounded-full ${score > 80 ? 'bg-orange-50 text-[#E76F51]' : 'bg-slate-50 text-slate-500'}`}>
          {score}%
        </span>
      </div>
      <h4 className="text-base font-black text-[#2A211D] truncate">{title}</h4>
      <p className="text-xs font-medium text-orange-900/40 mt-1 flex items-center gap-1">
        {score > 80 ? <CheckCircle2 size={12} className="text-emerald-500" /> : <Info size={12} className="text-amber-500" />}
        {status}
      </p>
      <button className="mt-2 text-[#E76F51] text-xs font-black flex items-center gap-1 hover:underline">
        Détails <ChevronRight size={14} />
      </button>
    </div>
  </div>
);

const MapMarker: React.FC<{ top: string; left: string; color: string }> = ({ top, left, color }) => (
  <div className={`absolute w-6 h-6 ${color} border-2 border-white rounded-full shadow-lg cursor-pointer transform -translate-x-1/2 -translate-y-1/2 hover:scale-150 transition-transform duration-300 z-10`} style={{ top, left }}>
    <div className={`absolute inset-0 ${color} rounded-full animate-ping opacity-20`}></div>
  </div>
);

const MapControl: React.FC<{ icon: React.ReactNode }> = ({ icon }) => (
  <button className="w-12 h-12 bg-white rounded-xl shadow-lg border border-orange-50 flex items-center justify-center text-orange-600 hover:text-[#E76F51] transition-colors">
    {icon}
  </button>
);
