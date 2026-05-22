# ☀️ AgadirAccess: Inclusion Sans Limite

AgadirAccess is a premium, impact-driven accessibility web platform designed to transform the city of Agadir into a world-class example of urban inclusion. Inspired by the warmth of the Moroccan sun and the vastness of the Atlantic, the platform provides real-time accessibility data, AI-driven routing, and crowdsourced reporting to ensure mobility for everyone.

![Theme: Sunset Glow](https://img.shields.io/badge/Theme-Sunset_Glow-E76F51?style=for-the-badge)
![Compliance: WCAG 2.1 AAA](https://img.shields.io/badge/Compliance-WCAG_2.1_AAA-emerald?style=for-the-badge)
![Framework: React + Next.js](https://img.shields.io/badge/Framework-Next.js_14-black?style=for-the-badge)

---

## 🎨 Design Philosophy: "Sunset Glow"

The interface moves away from cold corporate aesthetics to embrace **Moroccan Hospitality**. 
- **Colors**: Deep Saffron (`#E76F51`), Warm Gold (`#F4A261`), and Earthy Charcoal (`#2A211D`) on a Cream Sand background (`#FFFBF0`).
- **Visual Language**: High-end **Bento Grids**, glassmorphism overlays, and `rounded-2xl` organic corners.
- **Micro-interactions**: Fluid hover elevations, active-scale effects, and high-visibility focus states.

## 🚀 Key Features

### 1. 🏠 Impact-Driven Landing (HomePage)
A powerful entry point featuring "Impact Storytelling" and interactive feature tiles. It captures the user's attention within 3 seconds through premium motion and bold typography.

### 2. 🗺️ Smart Accessibility Map (MapPage)
A split-screen interface where accessibility isn't a toggle, but the foundation. Users can filter the city by specific needs (Wheelchair, Vision, Hearing) and see real-time "Accessibility Scores" for every venue.

### 3. 🔍 Granular Venue Insights (PlaceDetailsPage)
Deep dives into locations with a comprehensive "Accessibility Audit" checklist, verified community galleries, and inclusive reviews.

### 4. 🤖 AI Route Assistant (RouteAssistantPage)
An intuitive navigation engine that calculates the most accessible path, avoiding temporary obstacles and steep inclines, tailored to the user's specific mobility profile.

### 5. 📢 Crowdsourced Reporting (ReportPage)
A real-time community feed where citizens can report temporary obstacles (construction, illegal parking) with photo evidence, helping the city stay accessible 24/7.

## 🛠️ Technical Stack

- **Frontend**: React 18 + Next.js 14 (App Router)
- **Styling**: Tailwind CSS (Strict Utility-First)
- **State Management**: React Context API (`AccessibilityProvider`)
- **Icons**: Lucide React
- **Accessibility**: 
  - Dynamic Font Scaling
  - High Contrast Mode
  - RTL Support (Arabic Localization)
  - Aria-labels & Semantic HTML

## 📦 Project Structure

```bash
agadir-access/
├── components/          # Reusable UI primitives (Navbar, Footer, etc.)
├── context/             # Accessibility & Theme Global State
├── pages/               # High-fidelity page implementations
└── Layout.tsx           # Global wrapper for the platform
```

## 🚥 Getting Started

### Prerequisites
- Node.js 18+
- Tailwind CSS installed in your project

### Installation
1. Clone the project structure.
2. Install dependencies:
   ```bash
   npm install lucide-react framer-motion
   ```
3. Wrap your `_app.tsx` or `layout.tsx` with the `Layout` component:
   ```tsx
   import { Layout } from './agadir-access/Layout';

   export default function App({ Component, pageProps }) {
     return (
       <Layout>
         <Component {...pageProps} />
       </Layout>
     );
   }
   ```

---

## 🤝 Contribution & Vision
AgadirAccess is more than a tool; it's a movement. Our goal is to make every street, shop, and beach in Agadir accessible to the 15% of the global population living with disabilities.

**Made with ❤️ in Morocco for a better world.**
