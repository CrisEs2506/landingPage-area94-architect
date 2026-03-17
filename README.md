# Website Architect Area94


## Descripción
Landing page profesional para **Área 94**, empresa especializada en arquitectura, gestión urbanística y desarrollo inmobiliario integral.

The application includes:
- A hero section with a two‑column layout on desktop.
- A catalog of projects displayed in a responsive grid.
- An "About Us" section with styled cards.
- A contact form with server‑side handling via an API route.
- Navigation and interactive elements that match the design spec.

## Tech Stack

- **Framework**: Astro (static site generator)
- **Language**: TypeScript for API routes, Astro components for UI
- **Styling**: Vanilla CSS with CSS Grid and Flexbox, using the **Montserrat** and **Inter** fonts.
- **Build Tool**: Vite (via Astro)

## Getting Started

### Prerequisites

- Node.js (v18 or later)
- npm (v9 or later)

### Installation

```bash
# Clone the repository
git clone <repository-url>
cd website-architect

# Install dependencies
npm install
```

### Development Server

```bash
npm run dev
```

The site will be available at `http://localhost:4321`.

### Build for Production

```bash
npm run build
```

The compiled site will be output to the `dist/` directory.

### Preview Production Build

```bash
npm run preview
```

## Key Components

- **Hero.astro** – Two‑column hero on desktop, stacked on smaller screens.
- **Proyectos.astro** – Responsive project catalog (4‑col desktop, 2‑col tablet, 1‑col mobile).
- **Nosotros.astro** – "About Us" section with three styled cards.
- **Contact API (`src/pages/api/contact.ts`)** – Handles form submissions via SMTP (configured in environment variables).