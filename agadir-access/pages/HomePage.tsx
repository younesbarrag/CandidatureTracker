import React from 'react';
import { Accessibility, Map as MapIcon, Compass, Users, ArrowRight, Star, CheckCircle2, Waves, Eye, Volume2, Footprints, Sun } from 'lucide-react';

export const HomePage: React.FC = () => {
  return (
    <div className="bg-[#FFFBF0] min-h-screen">
      {/* Hero Section */}
      <section className="relative pt-20 pb-32 overflow-hidden">
        <div className="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-orange-50/50 to-transparent -z-10" />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div className="space-y-8">
              <div className="inline-flex items-center gap-2 bg-orange-50 border border-orange-100 px-4 py-2 rounded-full">
                <Sun className="text-[#E76F51]" size={18} />
                <span className="text-sm font-black text-[#E76F51] uppercase tracking-widest">Agadir Saffron 2026</span>
              </div>
              <h1 className="text-6xl md:text-7xl font-black text-[#2A211D] leading-[0.9] tracking-tighter">
                Explorez Agadir <br />
                <span className="text-transparent bg-clip-text bg-gradient-to-r from-[#E76F51] to-[#F4A261]">Sous le Soleil.</span>
              </h1>
              <p className="text-xl text-[#2A211D]/70 font-medium max-w-lg leading-relaxed">
                Naviguez dans la ville blanche avec une chaleur renouvelée. Une plateforme inclusive pensée pour l'hospitalité et l'autonomie.
              </p>
              <div className="flex flex-wrap gap-4">
                <button className="bg-[#E76F51] text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-[#d65d41] transition-all shadow-xl shadow-orange-200 flex items-center gap-2 group">
                  Ouvrir la Carte
                  <ArrowRight size={20} className="group-hover:translate-x-1 transition-transform" />
                </button>
                <button className="bg-white border-2 border-orange-100 text-[#2A211D] px-8 py-4 rounded-2xl font-bold text-lg hover:border-[#E76F51] hover:text-[#E76F51] transition-all">
                  Signaler un obstacle
                </button>
              </div>
              <div className="flex items-center gap-8 pt-4">
                <Stat value="450+" label="Lieux Vérifiés" />
                <Stat value="12k" label="Utilisateurs" />
                <Stat value="98%" label="Précision" />
              </div>
            </div>
            
            {/* Bento Grid Features */}
            <div className="grid grid-cols-2 gap-4 h-[600px]">
              <div className="bg-white p-8 rounded-[2rem] shadow-premium flex flex-col justify-between border border-orange-50 group hover:shadow-premium-hover transition-all">
                <div className="w-14 h-14 bg-orange-50 text-[#E76F51] rounded-2xl flex items-center justify-center">
                  <MapIcon size={28} />
                </div>
                <div>
                  <h3 className="text-xl font-black text-[#2A211D] mb-2">Carte Dorée</h3>
                  <p className="text-sm text-orange-900/40 font-medium leading-relaxed">Filtrage intelligent adapté à votre mobilité.</p>
                </div>
              </div>
              <div className="bg-[#2A211D] p-8 rounded-[2rem] shadow-xl text-white flex flex-col justify-between relative overflow-hidden group hover:scale-[1.02] transition-all">
                <Sun className="absolute -top-10 -right-10 w-40 h-40 text-white/5 rotate-12" />
                <div className="w-14 h-14 bg-white/10 backdrop-blur-md text-[#F4A261] rounded-2xl flex items-center justify-center">
                  <Compass size={28} />
                </div>
                <div>
                  <h3 className="text-xl font-black mb-2">IA Itinéraire</h3>
                  <p className="text-sm text-orange-100/60 font-medium leading-relaxed">Le chemin le plus fluide et le plus ensoleillé.</p>
                </div>
              </div>
              <div className="bg-[#F4A261] p-8 rounded-[2rem] shadow-xl text-white col-span-2 flex items-center gap-8 group hover:scale-[1.01] transition-all">
                <div className="w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center flex-shrink-0">
                  <Users size={40} />
                </div>
                <div>
                  <h3 className="text-2xl font-black mb-2">Communauté Solidaire</h3>
                  <p className="text-orange-50 font-medium">Rejoignez le mouvement pour une Agadir 100% accessible.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Impact Storytelling */}
      <section className="py-24 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-16">
          <div className="max-w-3xl mx-auto space-y-4">
            <h2 className="text-4xl font-black text-[#2A211D] tracking-tight">L'hospitalité marocaine au service de tous.</h2>
            <p className="text-lg text-orange-900/60 font-medium">Chaque citoyen mérite de profiter de la beauté d'Agadir. Nous transformons la ville, un signalement à la fois.</p>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-3 gap-12">
            <ImpactCard 
              icon={<Eye size={32} />} 
              title="Déficience Visuelle" 
              desc="Guidage vocal et contrastes optimisés pour une lecture facilitée." 
            />
            <ImpactCard 
              icon={<Footprints size={32} />} 
              title="Mobilité Réduite" 
              desc="Vérification physique des rampes et des accès prioritaires." 
            />
            <ImpactCard 
              icon={<Volume2 size={32} />} 
              title="Déficience Auditive" 
              desc="Alertes visuelles et informations textuelles riches sur chaque lieu." 
            />
          </div>
        </div>
      </section>

      {/* Testimonials */}
      <section className="py-24 bg-orange-50/30">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="bg-white rounded-[3rem] p-12 md:p-20 shadow-premium flex flex-col md:flex-row items-center gap-16 border border-orange-100">
            <div className="w-full md:w-1/3 aspect-square rounded-[2.5rem] bg-orange-50 overflow-hidden relative group">
              <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?w=800" alt="User" className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
            </div>
            <div className="flex-1 space-y-8">
              <div className="flex text-[#F4A261] gap-1">
                {[1,2,3,4,5].map(i => <Star key={i} fill="currentColor" size={24} />)}
              </div>
              <p className="text-3xl font-bold text-[#2A211D] italic leading-tight">
                "Une application qui redonne le sourire. Je peux enfin sortir sans avoir peur de me retrouver bloqué. L'interface est magnifique et chaleureuse."
              </p>
              <div>
                <p className="text-xl font-black text-[#2A211D]">Karim El Mansouri</p>
                <p className="text-[#E76F51] font-bold uppercase tracking-widest text-xs">Utilisateur depuis 2024</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* CTA */}
      <section className="py-32 overflow-hidden relative">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
          <h2 className="text-5xl md:text-6xl font-black text-[#2A211D] tracking-tighter">Éclairons ensemble <br /> le chemin de l'inclusion.</h2>
          <div className="flex justify-center gap-4">
             <button className="bg-[#E76F51] text-white px-10 py-5 rounded-2xl font-bold text-xl hover:bg-[#d65d41] transition-all shadow-xl shadow-orange-100">Télécharger l'App</button>
             <button className="bg-[#2A211D] text-white px-10 py-5 rounded-2xl font-bold text-xl hover:bg-black transition-all shadow-xl shadow-slate-200">Devenir Partenaire</button>
          </div>
        </div>
      </section>
    </div>
  );
};

const Stat: React.FC<{ value: string; label: string }> = ({ value, label }) => (
  <div>
    <p className="text-3xl font-black text-[#2A211D] tracking-tight">{value}</p>
    <p className="text-xs font-bold text-orange-900/40 uppercase tracking-widest">{label}</p>
  </div>
);

const ImpactCard: React.FC<{ icon: React.ReactNode; title: string; desc: string }> = ({ icon, title, desc }) => (
  <div className="text-left space-y-6 group cursor-default">
    <div className="w-16 h-16 bg-orange-50 text-[#E76F51] rounded-2xl flex items-center justify-center group-hover:bg-[#E76F51] group-hover:text-white transition-all duration-300">
      {icon}
    </div>
    <h3 className="text-2xl font-black text-[#2A211D]">{title}</h3>
    <p className="text-orange-900/60 font-medium leading-relaxed">{desc}</p>
    <div className="flex items-center gap-2 text-[#E76F51] font-bold text-sm">
      <span>En savoir plus</span>
      <ArrowRight size={16} />
    </div>
  </div>
);
