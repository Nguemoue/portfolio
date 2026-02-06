'use client'

import { motion } from 'framer-motion'
import { GraduationCap, Award } from 'lucide-react'

const education = [
  {
    id: 1,
    degree: 'Ingénieur en Genie Logicielle',
    school: 'IAI Cameroun',
    period: 'Octobre 2021 - Septembre 2022',
    details: [
      'Administrations de Base de données',
      'Développement Web',
      'Fonctionnements des Algorithmes',
    ],
  },
  {
    id: 2,
    degree: 'Technitiens Informatique',
    school: 'IAI Cameroun',
    period: 'Octobre 2020 - Août 2021',
    details: [
      "Système d'administration de base de données",
      'Fonctionnement du Web',
    ],
  },
]

const certifications = [
  {
    id: 1,
    title: 'Passez au Full Stack avec Node.js, Express et MongoDB',
    issuer: 'OpenClassrooms',
    date: '2023',
    link: 'https://openclassrooms.com/fr/course-certificates/6948932507',
  },
  {
    id: 2,
    title: 'Adoptez les API REST pour vos projets web',
    issuer: 'OpenClassrooms',
    date: '2023',
    link: 'https://openclassrooms.com/fr/course-certificates/3612077354',
  },
]

export default function Education() {
  return (
    <section id="education" className="py-20 bg-background">
      <div className="container mx-auto px-6">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          <h2 className="text-4xl font-bold text-center mb-4">Mon parcours</h2>
          <div className="w-20 h-px bg-foreground mx-auto mb-12" />
        </motion.div>

        <div className="max-w-4xl mx-auto space-y-12">
          {/* Education */}
          <div>
            <h3 className="text-2xl font-bold mb-6 flex items-center gap-2">
              <GraduationCap className="w-6 h-6" />
              Formation
            </h3>
            <div className="grid gap-6 md:grid-cols-2">
              {education.map((edu, index) => (
                <motion.div
                  key={edu.id}
                  initial={{ opacity: 0, y: 30 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: index * 0.1 }}
                  className="bg-background border border-foreground/10 rounded-md p-6 shadow-soft hover:shadow-soft-lg transition-shadow"
                >
                  <h4 className="text-xl font-bold text-foreground mb-2">{edu.degree}</h4>
                  <p className="text-foreground/70 font-semibold mb-2">{edu.school}</p>
                  <div className="text-sm text-foreground/60 mb-3">{edu.period}</div>
                  <ul className="text-foreground/70 list-disc pl-5 space-y-2">
                    {edu.details.map((detail) => (
                      <li key={detail}>{detail}</li>
                    ))}
                  </ul>
                </motion.div>
              ))}
            </div>
          </div>

          {/* Certifications */}
          <div>
            <h3 className="text-2xl font-bold mb-6 flex items-center gap-2">
              <Award className="w-6 h-6" />
              Certifications
            </h3>
            <div className="grid md:grid-cols-3 gap-6">
              {certifications.map((cert, index) => (
                <motion.div
                  key={cert.id}
                  initial={{ opacity: 0, y: 30 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: index * 0.1 }}
                  whileHover={{ y: -5 }}
                className="bg-background border border-foreground/10 rounded-md p-6 text-center shadow-soft hover:shadow-soft-lg transition-all"
              >
                <div className="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-sm border border-foreground/20">
                  <Award className="h-5 w-5" />
                </div>
                <h4 className="font-bold text-foreground mb-2">{cert.title}</h4>
                <p className="text-sm text-foreground/70 mb-1">{cert.issuer}</p>
                <p className="text-xs text-foreground/60 mb-3">{cert.date}</p>
                <a
                  href={cert.link}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-xs underline text-foreground/70 hover:text-foreground"
                >
                  Voir le certificat
                </a>
              </motion.div>
            ))}
          </div>
          </div>
        </div>
      </div>
    </section>
  )
}
