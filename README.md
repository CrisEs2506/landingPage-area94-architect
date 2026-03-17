# Dashboard de Arquitectura Área94

## Descripción
Landing page profesional para **Área 94**, empresa especializada en arquitectura, gestión urbanística y desarrollo inmobiliario integral.

La aplicación incluye:
- Una sección hero con un diseño de dos columnas en escritorio.
- Un catálogo de proyectos mostrado en una cuadrícula responsiva.
- Una sección "Sobre Nosotros" con tarjetas estilizadas.
- Un formulario de contacto con manejo del lado del servidor mediante una ruta API.
- Navegación y elementos interactivos que coinciden con el diseño especificado.

## Tecnologías

- **Framework**: Astro (generador de sitios estáticos)
- **Lenguaje**: TypeScript para rutas API y componentes Astro para la UI
- **Estilos**: CSS vanilla con CSS Grid y Flexbox, usando las fuentes **Montserrat** y **Inter**.
- **Herramienta de compilación**: Vite (a través de Astro)

## Empezando

### Requisitos previos

- Node.js (v18 o superior)
- npm (v9 o superior)

### Instalación

```bash
# Clonar el repositorio
git clone https://github.com/CrisEs2506/landingPage-area94-architect
cd website-architect

# Instalar dependencias
npm install
```

### Servidor de desarrollo

```bash
npm run dev
```

El sitio estará disponible en `http://localhost:4321`.

### Construcción para producción

```bash
npm run build
```

El sitio compilado se generará en el directorio `dist/`.

### Vista previa de la construcción

```bash
npm run preview
```

## Componentes clave

- **Hero.astro** – Hero de dos columnas en escritorio, apilado en pantallas más pequeñas.
- **Proyectos.astro** – Catálogo de proyectos responsivo (4 columnas en escritorio, 2 en tablet, 1 en móvil).
- **Nosotros.astro** – Sección "Sobre Nosotros" con tres tarjetas estilizadas.
- **API de contacto (`src/pages/api/contact.ts`)** – Gestiona el envío del formulario mediante SMTP (configurado en variables de entorno).
