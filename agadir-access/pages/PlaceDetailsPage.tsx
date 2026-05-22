import React from 'react';
import { Star, MapPin, Phone, Globe, Clock, CheckCircle2, XCircle, Camera, MessageSquare, Info, Heart, Share2, Sun } from 'lucide-react';

export const PlaceDetailsPage: React.FC = () => {
  return (
    <div className="bg-[#FFFBF0] min-h-screen pb-20">
      {/* Header Gallery */}
      <div className="h-[400px] grid grid-cols-4 gap-2 px-4 md:px-8 pt-4">
        <div className="col-span-2 row-span-2 rounded-[2rem] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1590001158193-790dc0ca007d?w=800" className="w-full h-full object-cover" alt="Main" />
        </div>
        <div className="rounded-[2rem] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=800" className="w-full h-full object-cover" alt="Gallery 1" />
        </div>
        <div className="rounded-[2rem] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1467803738586-46b7eb7b16a1?w=800" className="w-full h-full object-cover" alt="Gallery 2" />
        </div>
        <div className="col-span-2 h-[190px] rounded-[2rem] overflow-hidden relative group cursor-pointer">
          <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800" className="w-full h-full object-cover" alt="Gallery 3" />
          <div className="absolute inset-0 bg-black/40 flex items-center justify-center text-white font-black text-xl group-hover:bg-black/60 transition-all">
            +12 Photos
          </div>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 grid grid-cols-1 lg:grid-cols-3 gap-12">
        {/* Main Content */}
        <div className="lg:col-span-2 space-y-12">
          <div className="space-y-4">
            <div className="flex items-center gap-2">
              <span className="bg-orange-50 text-[#E76F51] px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">Marina</span>
              <div className="flex text-[#F4A261]">
                {[1,2,3,4,5].map(i => <Star key={i} size={14} fill="currentColor" />)}
              </div>
            </div>
            <h1 className="text-5xl font-black text-[#2A211D] tracking-tight">Marina d'Agadir</h1>
            <p className="text-xl text-orange-900/60 font-medium leading-relaxed">Un port de plaisance moderne, conçu pour l'inclusion sous la lumière dorée d'Agadir.</p>
          </div>

          {/* Accessibility Checklist */}
          <section className="bg-white rounded-[2.5rem] p-10 shadow-premium border border-orange-50">
            <h2 className="text-2xl font-black text-[#2A211D] mb-8 flex items-center gap-3">
              <Sun className="text-[#E76F51]" size={28} />
              Bilan d'Accessibilité
            </h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
              <CheckItem label="Rampe d'accès conforme" status="yes" />
              <CheckItem label="Toilettes PMR" status="yes" />
              <CheckItem label="Signalétique braille" status="partial" />
              <CheckItem label="Boucle magnétique" status="no" />
              <CheckItem label="Personnel formé" status="yes" />
              <CheckItem label="Parking réservé" status="yes" />
            </div>
          </section>

          {/* User Reviews */}
          <section className="space-y-8">
            <div className="flex justify-between items-end">
              <h2 className="text-2xl font-black text-[#2A211D]">Avis de la Communauté</h2>
              <button className="text-[#E76F51] font-black text-sm hover:underline">Voir tout</button>
            </div>
            <div className="space-y-6">
              <ReviewCard 
                user="Sara B." 
                date="Il y a 2 jours" 
                text="L'accès à la corniche est fluide, les pavés sont très bien entretenus pour les fauteuils." 
                rating={5}
              />
              <ReviewCard 
                user="Yassine K." 
                date="Il y a 1 semaine" 
                text="Magnifique au coucher du soleil. Très accessible et personnel chaleureux." 
                rating={4}
              />
            </div>
          </section>
        </div>

        {/* Sidebar Info */}
        <aside className="space-y-8">
          <div className="bg-[#2A211D] rounded-[2.5rem] p-8 text-white space-y-8 shadow-xl">
            <h3 className="text-xl font-black text-[#F4A261]">Informations Pratiques</h3>
            <div className="space-y-6">
              <InfoLink icon={<MapPin size={20} />} label="Marina, Agadir 80000" />
              <InfoLink icon={<Phone size={20} />} label="+212 528 123 456" />
              <InfoLink icon={<Globe size={20} />} label="www.marinaagadir.com" />
              <InfoLink icon={<Clock size={20} />} label="Ouvert 24h/24" />
            </div>
            <button className="w-full bg-[#E76F51] py-4 rounded-2xl font-black text-lg hover:bg-[#d65d41] transition-all shadow-lg shadow-orange-500/20">
              Y aller
            </button>
          </div>

          <div className="flex gap-4">
            <button className="flex-1 bg-white border border-orange-100 py-4 rounded-2xl font-bold text-[#2A211D] flex items-center justify-center gap-2 hover:bg-orange-50 transition-all">
              <Heart size={20} /> Enregistrer
            </button>
            <button className="flex-1 bg-white border border-orange-100 py-4 rounded-2xl font-bold text-[#2A211D] flex items-center justify-center gap-2 hover:bg-orange-50 transition-all">
              <Share2 size={20} /> Partager
            </button>
          </div>
        </aside>
      </div>
    </div>
  );
};

const CheckItem: React.FC<{ label: string; status: 'yes' | 'no' | 'partial' }> = ({ label, status }) => (
  <div className="flex items-center justify-between p-4 bg-orange-50/30 rounded-2xl">
    <span className="font-bold text-orange-900/60">{label}</span>
    {status === 'yes' && <CheckCircle2 size={24} className="text-emerald-500" />}
    {status === 'no' && <XCircle size={24} className="text-rose-500" />}
    {status === 'partial' && <Info size={24} className="text-amber-500" />}
  </div>
);

const ReviewCard: React.FC<{ user: string; date: string; text: string; rating: number }> = ({ user, date, text, rating }) => (
  <div className="bg-white p-6 rounded-3xl border border-orange-50 space-y-4 shadow-sm">
    <div className="flex justify-between items-center">
      <div className="flex items-center gap-3">
        <div className="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center text-[#E76F51] font-black text-sm">
          {user[0]}
        </div>
        <div>
          <p className="font-black text-[#2A211D]">{user}</p>
          <p className="text-[10px] font-bold text-orange-900/40 uppercase tracking-widest">{date}</p>
        </div>
      </div>
      <div className="flex text-[#F4A261]">
        {[...Array(rating)].map((_, i) => <Star key={i} size={12} fill="currentColor" />)}
      </div>
    </div>
    <p className="text-orange-900/60 font-medium leading-relaxed">{text}</p>
  </div>
);

const InfoLink: React.FC<{ icon: React.ReactNode; label: string }> = ({ icon, label }) => (
  <div className="flex items-center gap-4 group cursor-pointer">
    <div className="text-orange-300 group-hover:scale-110 transition-transform">{icon}</div>
    <span className="text-sm font-bold text-orange-100/60 group-hover:text-white transition-colors">{label}</span>
  </div>
);
