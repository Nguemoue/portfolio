'use client'

import { useState } from 'react'
import { motion } from 'framer-motion'
import { Send, Mail, Phone, MapPin } from 'lucide-react'
import { Button } from '@/components/ui/button'

export default function Contact() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    subject: '',
    message: '',
  })

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    // TODO: Implement form submission
    console.log('Form submitted:', formData)
  }

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    })
  }

  return (
    <section id="contact" className="py-20 bg-background">
      <div className="container mx-auto px-6">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          <h2 className="text-4xl font-bold text-center mb-4">Me contacter</h2>
          <div className="w-20 h-px bg-foreground mx-auto mb-8" />
          <p className="text-center text-foreground/70 max-w-2xl mx-auto mb-12">
            Une question ? Un projet ? N'hésitez pas à me contacter, je vous répondrai dans les plus brefs délais.
          </p>
        </motion.div>

        <div className="max-w-5xl mx-auto grid md:grid-cols-2 gap-12">
          {/* Contact Info */}
          <motion.div
            initial={{ opacity: 0, x: -50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            className="space-y-6"
          >
            <h3 className="text-2xl font-bold mb-6">Informations de contact</h3>

            <div className="space-y-4">
              <div className="flex items-start gap-4 p-4 bg-background border border-foreground/10 rounded-md shadow-soft hover:shadow-soft-lg transition-shadow">
                <div className="w-12 h-12 border border-foreground/20 rounded-sm flex items-center justify-center flex-shrink-0">
                  <Mail className="w-6 h-6" />
                </div>
                <div>
                  <h4 className="font-semibold text-foreground mb-1">Email</h4>
                  <a
                    href="mailto:lucchuala@gmail.com"
                    className="text-foreground/70 hover:text-foreground transition-colors"
                  >
                    lucchuala@gmail.com
                  </a>
                </div>
              </div>

              <div className="flex items-start gap-4 p-4 bg-background border border-foreground/10 rounded-md shadow-soft hover:shadow-soft-lg transition-shadow">
                <div className="w-12 h-12 border border-foreground/20 rounded-sm flex items-center justify-center flex-shrink-0">
                  <Phone className="w-6 h-6" />
                </div>
                <div>
                  <h4 className="font-semibold text-foreground mb-1">Téléphone</h4>
                  <a
                    href="tel:+237699568073"
                    className="text-foreground/70 hover:text-foreground transition-colors"
                  >
                    +237 699 568 073
                  </a>
                </div>
              </div>

              <div className="flex items-start gap-4 p-4 bg-background border border-foreground/10 rounded-md shadow-soft hover:shadow-soft-lg transition-shadow">
                <div className="w-12 h-12 border border-foreground/20 rounded-sm flex items-center justify-center flex-shrink-0">
                  <MapPin className="w-6 h-6" />
                </div>
                <div>
                  <h4 className="font-semibold text-foreground mb-1">Localisation</h4>
                  <p className="text-foreground/70">Yaoundé, Cameroun</p>
                </div>
              </div>
            </div>
          </motion.div>

          {/* Contact Form */}
          <motion.div
            initial={{ opacity: 0, x: 50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
          >
            <form onSubmit={handleSubmit} className="bg-background border border-foreground/10 rounded-md p-8 shadow-soft-lg space-y-6">
              <div>
                <label htmlFor="name" className="block text-sm font-medium text-foreground mb-2">
                  Nom complet
                </label>
                <input
                  type="text"
                  id="name"
                  name="name"
                  value={formData.name}
                  onChange={handleChange}
                  required
                  className="w-full px-4 py-3 border border-foreground/20 rounded-sm focus:ring-2 focus:ring-foreground focus:border-foreground outline-none transition-all bg-background text-foreground"
                  placeholder="Votre nom"
                />
              </div>

              <div>
                <label htmlFor="email" className="block text-sm font-medium text-foreground mb-2">
                  Email
                </label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  value={formData.email}
                  onChange={handleChange}
                  required
                  className="w-full px-4 py-3 border border-foreground/20 rounded-sm focus:ring-2 focus:ring-foreground focus:border-foreground outline-none transition-all bg-background text-foreground"
                  placeholder="votre@email.com"
                />
              </div>

              <div>
                <label htmlFor="subject" className="block text-sm font-medium text-foreground mb-2">
                  Sujet
                </label>
                <input
                  type="text"
                  id="subject"
                  name="subject"
                  value={formData.subject}
                  onChange={handleChange}
                  required
                  className="w-full px-4 py-3 border border-foreground/20 rounded-sm focus:ring-2 focus:ring-foreground focus:border-foreground outline-none transition-all bg-background text-foreground"
                  placeholder="Sujet du message"
                />
              </div>

              <div>
                <label htmlFor="message" className="block text-sm font-medium text-foreground mb-2">
                  Message
                </label>
                <textarea
                  id="message"
                  name="message"
                  value={formData.message}
                  onChange={handleChange}
                  required
                  rows={5}
                  className="w-full px-4 py-3 border border-foreground/20 rounded-sm focus:ring-2 focus:ring-foreground focus:border-foreground outline-none transition-all resize-none bg-background text-foreground"
                  placeholder="Votre message..."
                />
              </div>

              <Button type="submit" size="lg" className="w-full">
                <Send className="w-4 h-4 mr-2" />
                Envoyer le message
              </Button>
            </form>
          </motion.div>
        </div>
      </div>
    </section>
  )
}
