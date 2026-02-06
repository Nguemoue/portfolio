'use client'

import { motion } from 'framer-motion'
import { GraduationCap, Award } from 'lucide-react'

const education = [
  {
    id: 1,
    degree: 'Licence en Informatique',
    school: 'Institut Africain d\'Informatique',
    location: 'Yaoundé, Cameroun',
    period: '2018 - 2021',
    description: 'Formation en développement logiciel, bases de données et réseaux.',
  },
]

const certifications = [
  {
    id: 1,
    title: 'Laravel Advanced',
    issuer: 'Laracasts',
    date: '2023',
  },
  {
    id: 2,
    title: 'AWS Cloud Practitioner',
    issuer: 'Amazon',
    date: '2023',
  },
  {
    id: 3,
    title: 'React Developer',
    issuer: 'Meta',
    date: '2022',
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
                <div className="flex flex-wrap items-center gap-4 text-sm text-foreground/60 mb-3">
                  <span>{edu.location}</span>
                  <span>•</span>
                  <span>{edu.period}</span>
                </div>
                <p className="text-foreground/70">{edu.description}</p>
              </motion.div>
            ))}
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
                <p className="text-xs text-foreground/60">{cert.date}</p>
              </motion.div>
            ))}
          </div>
          </div>
        </div>
      </div>
    </section>
  )
}
