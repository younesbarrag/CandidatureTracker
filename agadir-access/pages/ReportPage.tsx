import React from 'react';
import { AlertTriangle, Camera, MapPin, Send, Clock, ThumbsUp, MessageCircle, MoreHorizontal, Sun } from 'lucide-react';

export const ReportPage: React.FC = () => {
  return (
    <div className="bg-[#FFFBF0] min-h-screen py-16">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        {/* Report Form */}
        <div className="lg:col-span-1 space-y-8">
          <div className="space-y-4">
            <h1 className="text-4xl font-black text-[#2A211D] tracking-tight">Signaler un Obstacle</h1>
            <p className="text-orange-900/60 font-medium leading-relaxed">
              Une marche trop haute ? Des travaux non signalés ? Votre signalement aide toute la communauté sous le soleil d'Agadir.
            </p>
          </div>

          <form className="bg-white rounded-[2.5rem] p-8 shadow-premium border border-orange-50 space-y-6">
            <div className="space-y-2">
              <label className="text-[10px] font-black text-orange-900/40 uppercase tracking-widest ml-4">Type de problème</label>
              <select className="w-full px-6 py-4 bg-orange-50/30 border-none rounded-2xl focus:ring-2 focus:ring-[#E76F51] outline-none font-bold text-[#2A211D] appearance-none">
                <option>Trottoir endommagé</option>
                <option>Travaux sans passage PMR</option>
                <option>Obstacle temporaire</option>
                <option>Signalétique manquante</option>
              </select>
            </div>

            <div className="space-y-2">
              <label className="text-[10px] font-black text-orange-900/40 uppercase tracking-widest ml-4">Description</label>
              <textarea 
                rows={4} 
                placeholder="Dites-nous en plus..." 
                className="w-full px-6 py-4 bg-orange-50/30 border-none rounded-2xl focus:ring-2 focus:ring-[#E76F51] outline-none font-bold text-[#2A211D] resize-none"
              ></textarea>
            </div>

            <div className="grid grid-cols-2 gap-4">
              <button type="button" className="flex flex-col items-center justify-center gap-2 p-6 bg-orange-50/30 rounded-2xl border-2 border-dashed border-orange-100 text-orange-400 hover:border-[#E76F51] hover:text-[#E76F51] transition-all">
                <Camera size={24} />
                <span className="text-[10px] font-black uppercase tracking-widest">Photo</span>
              </button>
              <button type="button" className="flex flex-col items-center justify-center gap-2 p-6 bg-orange-50/30 rounded-2xl border-2 border-dashed border-orange-100 text-orange-400 hover:border-[#E76F51] hover:text-[#E76F51] transition-all">
                <MapPin size={24} />
                <span className="text-[10px] font-black uppercase tracking-widest">Position</span>
              </button>
            </div>

            <button className="w-full bg-[#E76F51] text-white py-4 rounded-2xl font-black text-lg hover:bg-[#d65d41] transition-all shadow-xl shadow-orange-100 flex items-center justify-center gap-2">
              Envoyer le Signalement <Send size={20} />
            </button>
          </form>

          <div className="bg-orange-50 rounded-3xl p-6 flex items-start gap-4 border border-orange-100">
             <AlertTriangle className="text-[#E76F51] flex-shrink-0" size={24} />
             <p className="text-xs text-orange-900/60 font-medium leading-relaxed">
               <strong>Note :</strong> Pour les urgences vitales, veuillez contacter directement les services de secours (150).
             </p>
          </div>
        </div>

        {/* Real-time Feed */}
        <div className="lg:col-span-2 space-y-8">
          <div className="flex justify-between items-center">
             <h2 className="text-2xl font-black text-[#2A211D]">Signalements Récents</h2>
             <div className="flex gap-2">
               <span className="flex items-center gap-1.5 bg-orange-100 text-[#E76F51] px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">
                 <div className="w-1.5 h-1.5 rounded-full bg-[#E76F51] animate-pulse"></div>
                 Live
               </span>
             </div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <ReportCard 
              type="Travaux" 
              location="Avenue Mohammed V" 
              time="Il y a 5 min" 
              desc="Passage piéton bloqué par des travaux de voirie. Aucune rampe temporaire installée." 
              likes={12}
              comments={3}
              urgent
            />
            <ReportCard 
              type="Obstacle" 
              location="Corniche d'Agadir" 
              time="Il y a 24 min" 
              desc="Véhicule mal garé sur le trottoir au niveau de la rampe d'accès à la plage." 
              likes={8}
              comments={1}
            />
            <ReportCard 
              type="Signalétique" 
              location="Quartier Talborjt" 
              time="Il y a 1 heure" 
              desc="Feu sonore en panne au croisement de la rue de l'Entraide." 
              likes={15}
              comments={5}
            />
            <ReportCard 
              type="Trottoir" 
              location="Secteur Touristique" 
              time="Il y a 3 heures" 
              desc="Dalle descellée et dangereuse pour les personnes à mobilité réduite." 
              likes={4}
              comments={0}
            />
          </div>
        </div>
      </div>
    </div>
  );
};

const ReportCard: React.FC<{ type: string; location: string; time: string; desc: string; likes: number; comments: number; urgent?: boolean }> = ({ type, location, time, desc, likes, comments, urgent }) => (
  <div className="bg-white p-6 rounded-[2rem] border border-orange-50 shadow-sm space-y-6 group hover:shadow-md transition-all">
    <div className="flex justify-between items-start">
      <div className="space-y-1">
        <div className="flex items-center gap-2">
          <span className={`text-[10px] font-black uppercase tracking-widest px-2 py-0.5 rounded-full ${urgent ? 'bg-orange-50 text-[#E76F51]' : 'bg-orange-50/30 text-orange-400'}`}>
            {type}
          </span>
          <span className="text-[10px] font-bold text-orange-900/40 flex items-center gap-1">
            <Clock size={10} /> {time}
          </span>
        </div>
        <h3 className="text-base font-black text-[#2A211D] flex items-center gap-1">
          <MapPin size={14} className="text-[#E76F51]" /> {location}
        </h3>
      </div>
      <button className="text-orange-200 hover:text-orange-400"><MoreHorizontal size={20} /></button>
    </div>

    <p className="text-sm text-orange-900/60 font-medium leading-relaxed italic">"{desc}"</p>

    <div className="flex items-center justify-between pt-4 border-t border-orange-50">
      <div className="flex gap-4">
        <button className="flex items-center gap-1.5 text-xs font-bold text-orange-400 hover:text-[#E76F51] transition-colors">
          <ThumbsUp size={16} /> {likes}
        </button>
        <button className="flex items-center gap-1.5 text-xs font-bold text-orange-400 hover:text-[#E76F51] transition-colors">
          <MessageCircle size={16} /> {comments}
        </button>
      </div>
      <button className="text-[10px] font-black text-[#E76F51] uppercase tracking-widest hover:underline">Vérifier</button>
    </div>
  </div>
);
