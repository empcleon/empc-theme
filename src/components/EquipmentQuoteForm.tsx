import React, { useState } from 'react';
import { Check, Send } from 'lucide-react';

type FormState = {
    name: string; email: string; phone: string; equipment: string; brandModel: string;
    age: string; problem: string; starts: string; powersOn: string; damage: string;
    dataRecovery: string; location: string; website: string; consent: boolean;
};

const initialState: FormState = {
    name: '', email: '', phone: '', equipment: '', brandModel: '', age: '', problem: '',
    starts: '', powersOn: '', damage: '', dataRecovery: '', location: '', website: '', consent: false,
};

const inputClass = 'w-full rounded-xl border border-slate-700 bg-slate-900 px-4 py-3 text-white outline-none transition focus:border-[#E29595] focus:ring-1 focus:ring-[#E29595]';

export default function EquipmentQuoteForm() {
    const [form, setForm] = useState(initialState);
    const [status, setStatus] = useState<'idle' | 'sending' | 'success' | 'error'>('idle');
    const [error, setError] = useState('');
    const set = (key: keyof FormState, value: string | boolean) => setForm((current) => ({ ...current, [key]: value }));

    async function submit(event: React.FormEvent) {
        event.preventDefault();
        setStatus('sending'); setError('');
        const message = [
            `Equipo: ${form.equipment}`, `Marca/modelo: ${form.brandModel}`, `Antigüedad: ${form.age}`,
            `Problema: ${form.problem}`, `Desde cuándo: ${form.starts}`, `¿Enciende?: ${form.powersOn}`,
            `Golpes o líquidos: ${form.damage}`, `Recuperación de datos: ${form.dataRecovery}`,
            `Localidad: ${form.location}`, '', 'El cliente solicita presupuesto previo y acepta que no se inicia el trabajo sin presupuesto aceptado y pago acordado.'
        ].join('\n');
        try {
            const base = window.empcData?.restUrl || `${window.location.origin}/wp-json/`;
            const response = await fetch(new URL('empc/v1/contact', base).toString(), {
                method: 'POST', headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': window.empcData?.nonce || '' },
                body: JSON.stringify({ name: form.name, email: form.email, phone: form.phone, service: 'Mantenimiento y reparación de equipos informáticos', message, website: form.website, consent: form.consent })
            });
            const payload = await response.json().catch(() => null);
            if (!response.ok) throw new Error(payload?.message || 'No se ha podido enviar la solicitud.');
            setStatus('success'); setForm(initialState);
        } catch (caught) { setStatus('error'); setError(caught instanceof Error ? caught.message : 'No se ha podido enviar la solicitud.'); }
    }

    if (status === 'success') return <div className="rounded-2xl border border-emerald-500/30 bg-emerald-500/10 p-8 text-center"><Check className="mx-auto mb-4 text-emerald-400" size={40} /><h3 className="text-2xl font-bold text-white">Solicitud recibida</h3><p className="mt-3 text-slate-300">Te responderé con las preguntas o el presupuesto que falte antes de empezar cualquier trabajo.</p><button className="mt-6 text-emerald-300 underline" onClick={() => setStatus('idle')}>Enviar otra solicitud</button></div>;

    return <form onSubmit={submit} className="space-y-6">
        <div className="sr-only" aria-hidden="true"><label htmlFor="eq-website">Website</label><input id="eq-website" name="website" value={form.website} onChange={(e) => set('website', e.target.value)} autoComplete="off" tabIndex={-1} /></div>
        <div className="grid md:grid-cols-2 gap-5">
            <label className="space-y-2"><span>Nombre o empresa *</span><input className={inputClass} required value={form.name} onChange={(e) => set('name', e.target.value)} /></label>
            <label className="space-y-2"><span>Email *</span><input className={inputClass} type="email" required value={form.email} onChange={(e) => set('email', e.target.value)} /></label>
            <label className="space-y-2"><span>Teléfono</span><input className={inputClass} type="tel" value={form.phone} onChange={(e) => set('phone', e.target.value)} /></label>
            <label className="space-y-2"><span>Localidad *</span><input className={inputClass} required value={form.location} onChange={(e) => set('location', e.target.value)} placeholder="León, Navatejera..." /></label>
            <label className="space-y-2"><span>Tipo de equipo *</span><select className={inputClass} required value={form.equipment} onChange={(e) => set('equipment', e.target.value)}><option value="">Selecciona...</option><option>Portátil</option><option>Ordenador de sobremesa</option><option>Equipo de oficina</option><option>Otro</option></select></label>
            <label className="space-y-2"><span>Marca y modelo</span><input className={inputClass} value={form.brandModel} onChange={(e) => set('brandModel', e.target.value)} placeholder="Si lo conoces" /></label>
            <label className="space-y-2"><span>Antigüedad aproximada</span><input className={inputClass} value={form.age} onChange={(e) => set('age', e.target.value)} placeholder="Ej. 8 años" /></label>
            <label className="space-y-2"><span>¿El equipo enciende?</span><select className={inputClass} value={form.powersOn} onChange={(e) => set('powersOn', e.target.value)}><option value="">Selecciona...</option><option>Sí, funciona pero tiene problemas</option><option>Enciende pero no inicia correctamente</option><option>No enciende</option><option>No lo sé</option></select></label>
        </div>
        <label className="block space-y-2"><span>¿Qué problema tiene? *</span><textarea className={inputClass} required rows={4} value={form.problem} onChange={(e) => set('problem', e.target.value)} placeholder="Describe los síntomas y qué necesitas." /></label>
        <div className="grid md:grid-cols-2 gap-5"><label className="space-y-2"><span>¿Desde cuándo ocurre?</span><input className={inputClass} value={form.starts} onChange={(e) => set('starts', e.target.value)} /></label><label className="space-y-2"><span>¿Ha sufrido golpes o líquidos?</span><select className={inputClass} value={form.damage} onChange={(e) => set('damage', e.target.value)}><option value="">Selecciona...</option><option>No</option><option>Sí</option><option>No lo sé</option></select></label><label className="space-y-2"><span>¿Necesitas recuperar datos?</span><select className={inputClass} value={form.dataRecovery} onChange={(e) => set('dataRecovery', e.target.value)}><option value="">Selecciona...</option><option>No</option><option>Sí, es importante</option><option>No lo sé</option></select></label></div>
        <label className="flex gap-3 items-start text-sm text-slate-400"><input type="checkbox" required checked={form.consent} onChange={(e) => set('consent', e.target.checked)} className="mt-1" />Acepto que EMPC use estos datos para responder a mi solicitud y preparar un presupuesto. Entiendo que no se inicia ningún trabajo sin presupuesto aceptado y pago acordado.</label>
        {status === 'error' && <p className="text-red-300" role="alert">{error}</p>}
        <button disabled={status === 'sending'} className="inline-flex items-center gap-2 rounded-xl bg-[#E29595] px-6 py-3 font-bold text-[#121826] disabled:opacity-60" type="submit"><Send size={18} />{status === 'sending' ? 'Enviando...' : 'Solicitar presupuesto'}</button>
    </form>;
}
