'use client'

import { motion } from 'framer-motion'
import { Briefcase, Calendar } from 'lucide-react'

const experiences = [
  {
    id: 1,
    company: 'Kamix',
    position: 'Développeur Web',
    period: 'January 2023 - Present',
    responsibilities: [
      'Mise en place des technologies et de la documentation du projet.',
      "Développement d'une solutions de Sondages.",
      'Tester et corriger les bugs.',
      'Effectuers des déploiement réguliers sur des serveurs en ligne ...',
    ],
    current: true,
  },
  {
    id: 2,
    company: 'Kozao.',
    position: 'Stagiaire (Jalios)',
    period: 'Novembre 2022 - Decembre 2022',
    responsibilities: [
      'Initiation au Framework JALIOS.',
      'Création des Gabarit (Jalios)',
    ],
    current: false,
  },
]

export default function Experience() {
  return (
    <section id="experience" className="py-20 bg-background">
      <div className="container mx-auto px-6">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          <h2 className="text-4xl font-bold text-center mb-4">Mes expériences</h2>
          <div className="w-20 h-px bg-foreground mx-auto mb-12" />
        </motion.div>

        <div className="max-w-4xl mx-auto">
            <div className="relative">
              {/* Timeline line */}
              <div className="absolute left-8 top-0 bottom-0 w-px bg-foreground/20" />

            {experiences.map((exp, index) => (
              <motion.div
                key={exp.id}
                initial={{ opacity: 0, x: -50 }}
                whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.2 }}
                className="relative pl-20 pb-12 last:pb-0"
              >
                {/* Timeline dot */}
                <div className="absolute left-6 top-0 w-4 h-4 rounded-sm bg-foreground border-2 border-background" />

                {/* Card */}
                <div className="bg-background border border-foreground/10 rounded-md p-6 shadow-soft hover:shadow-soft-lg transition-shadow">
                  <div className="flex items-start justify-between mb-3">
                    <div>
                      <h3 className="text-xl font-bold text-foreground">{exp.position}</h3>
                      <p className="text-foreground/70 font-semibold">{exp.company}</p>
                    </div>
                    {exp.current && (
                      <span className="border border-foreground/20 text-foreground text-xs px-3 py-1 rounded-sm">
                        En cours
                      </span>
                    )}
                  </div>

                  <div className="flex items-center gap-2 text-foreground/60 text-sm mb-4">
                    <Calendar className="w-4 h-4" />
                    <span>{exp.period}</span>
                  </div>

                  <ul className="text-foreground/70 list-disc pl-5 space-y-2">
                    {exp.responsibilities.map((item) => (
                      <li key={item}>{item}</li>
                    ))}
                  </ul>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
