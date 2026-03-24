/*import type { APIRoute } from 'astro';
import nodemailer from 'nodemailer';

export const prerender = false;

const transporter = nodemailer.createTransport({
  host: 'smtp.hostinger.com',
  port: 465,
  secure: true, // SSL
  auth: {
    user: 'contacto@area-94.com',
    pass: 'Schiaparelli12$',
  },
});

export const POST: APIRoute = async ({ request }) => {
  try {
    const body = await request.json();
    const { nombre, correo, telefono, mensaje } = body;

    // ── Validación del lado del servidor ──
    if (!nombre || !nombre.trim()) {
      return new Response(
        JSON.stringify({ success: false, error: 'El nombre es obligatorio.' }),
        { status: 400, headers: { 'Content-Type': 'application/json' } }
      );
    }

    if (!correo || !correo.trim()) {
      return new Response(
        JSON.stringify({ success: false, error: 'El correo es obligatorio.' }),
        { status: 400, headers: { 'Content-Type': 'application/json' } }
      );
    }

    // Validar formato de email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(correo.trim())) {
      return new Response(
        JSON.stringify({ success: false, error: 'El formato de correo no es válido.' }),
        { status: 400, headers: { 'Content-Type': 'application/json' } }
      );
    }

    if (!mensaje || !mensaje.trim()) {
      return new Response(
        JSON.stringify({ success: false, error: 'El mensaje es obligatorio.' }),
        { status: 400, headers: { 'Content-Type': 'application/json' } }
      );
    }

    // ── Construir el email ──
    const htmlContent = `
      <div style="font-family: 'Montserrat', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #f7f7f7; border-radius: 8px; overflow: hidden;">
        <div style="background: #23272F; padding: 32px 24px; text-align: center;">
          <h1 style="color: #c9a96e; margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -0.3px;">
            Nuevo mensaje de contacto
          </h1>
        </div>
        <div style="padding: 32px 24px;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; font-weight: 600; color: #23272F; width: 120px; vertical-align: top;">Nombre:</td>
              <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; color: #444;">${escapeHtml(nombre.trim())}</td>
            </tr>
            <tr>
              <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; font-weight: 600; color: #23272F; vertical-align: top;">Correo:</td>
              <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; color: #444;">
                <a href="mailto:${escapeHtml(correo.trim())}" style="color: #444; text-decoration: none;">${escapeHtml(correo.trim())}</a>
              </td>
            </tr>
            ${telefono && telefono.trim() ? `
            <tr>
              <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; font-weight: 600; color: #23272F; vertical-align: top;">Teléfono:</td>
              <td style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; color: #444;">${escapeHtml(telefono.trim())}</td>
            </tr>
            ` : ''}
            <tr>
              <td style="padding: 12px 0; font-weight: 600; color: #23272F; vertical-align: top;">Mensaje:</td>
              <td style="padding: 12px 0; color: #444; white-space: pre-wrap;">${escapeHtml(mensaje.trim())}</td>
            </tr>
          </table>
        </div>
        <div style="background: #23272F; padding: 16px 24px; text-align: center;">
          <p style="color: rgba(255,255,255,0.5); font-size: 12px; margin: 0;">
            Este mensaje fue enviado desde el formulario de contacto de area-94.com
          </p>
        </div>
      </div>
    `;

    await transporter.sendMail({
      from: `"Área 94 – Web" <contacto@area-94.com>`,
      to: 'contacto@area-94.com',
      replyTo: correo.trim(),
      subject: `Nuevo contacto: ${nombre.trim()}`,
      html: htmlContent,
    });

    return new Response(
      JSON.stringify({ success: true, message: 'Mensaje enviado correctamente.' }),
      { status: 200, headers: { 'Content-Type': 'application/json' } }
    );
  } catch (error) {
    console.error('Error al enviar correo:', error);
    return new Response(
      JSON.stringify({ success: false, error: 'Error al enviar el mensaje. Intenta de nuevo más tarde.' }),
      { status: 500, headers: { 'Content-Type': 'application/json' } }
    );
  }
};

/** Escapa caracteres HTML para prevenir inyección XSS.
function escapeHtml(str: string): string {
  return str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}
*/