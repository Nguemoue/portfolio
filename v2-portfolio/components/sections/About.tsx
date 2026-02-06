'use client'

import { motion } from 'framer-motion'
import { Phone, MapPin, Mail, Code2, Bot, Layers, Cloud } from 'lucide-react'

const interests = [
  { name: 'Développement Web', icon: Code2 },
  { name: 'Intelligence Artificielle', icon: Bot },
  { name: 'Architecture Logicielle', icon: Layers },
  { name: 'Cloud Computing', icon: Cloud },
]

export default function About() {
  return (
    <section id="about" className="py-20 bg-background">
      <div className="container mx-auto px-6">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.5 }}
        >
          <h2 className="text-4xl font-bold text-center mb-4">À propos</h2>
          <div className="w-20 h-px bg-foreground mx-auto mb-12" />
        </motion.div>

        <div className="grid gap-12 items-center">
          {/* Content */}
          <motion.div
            initial={{ opacity: 0, x: 50 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.5 }}
            className="space-y-6"
          >
            <p className="text-lg text-foreground/70 leading-relaxed">
              <span className="text-6xl text-foreground float-left mr-4 leading-none">D</span>
              éveloppeur concentré et enthousiaste, avec un intérêt marqué pour le développement 
              de logiciels et l'intelligence artificielle. Grâce à une exposition complète aux 
              concepts sous-jacents et à leur application à divers projets, mon amour pour ces 
              domaines est né.
            </p>
            <p className="text-lg text-foreground/70 leading-relaxed">
              Je suis une personne passionnée qui aime construire et appliquer des algorithmes 
              pour résoudre des problèmes industriels concrets.
            </p>

            {/* Contact Info */}
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-6">
              <div className="flex items-center gap-3 text-foreground/70">
                <Phone className="w-5 h-5" />
                <span>+237 699 568 073</span>
              </div>
              <div className="flex items-center gap-3 text-foreground/70">
                <MapPin className="w-5 h-5" />
                <span>Yaoundé, Cameroun</span>
              </div>
              <div className="flex items-center gap-3 text-foreground/70 sm:col-span-2">
                <Mail className="w-5 h-5" />
                <span>lucchuala@gmail.com</span>
              </div>
            </div>
          </motion.div>
        </div>

        {/* Interests */}
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.5, delay: 0.2 }}
          className="mt-16"
        >
          <h3 className="text-2xl font-bold text-center mb-8">Centres d'intérêts</h3>
          <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
            {interests.map((interest, index) => (
              <motion.div
                key={interest.name}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                whileHover={{ y: -5 }}
                className="bg-background border border-foreground/10 rounded-md p-6 text-center shadow-soft hover:shadow-soft-lg transition-all"
              >
                <interest.icon className="w-8 h-8 mx-auto mb-3 text-foreground" />
                <h4 className="font-semibold text-foreground">{interest.name}</h4>
              </motion.div>
            ))}
          </div>
        </motion.div>
      </div>
    </section>
  )
}
