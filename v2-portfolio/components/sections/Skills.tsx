'use client'

import { motion } from 'framer-motion'
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'

const skillCategories = [
  {
    name: 'Langages et Bases de données',
    skills: [
      { name: 'HTML5', level: 90 },
      { name: 'CSS3', level: 88 },
      { name: 'JavaScript', level: 85 },
      { name: 'MySQL', level: 85 },
      { name: 'PostgreSQL', level: 80 },
    ],
  },
  {
    name: 'Frameworks',
    skills: [
      { name: 'Laravel', level: 95 },
      { name: 'Bootstrap', level: 85 },
      { name: 'Vue.js', level: 80 },
      { name: 'Scikit-learn', level: 70 },
    ],
  },
  {
    name: 'Outils & DevOps',
    skills: [
      { name: 'Git', level: 90 },
      { name: 'AWS', level: 75 },
      { name: 'Google Cloud', level: 70 },
      { name: 'Heroku', level: 70 },
      { name: 'Plesk', level: 65 },
    ],
  },
]

export default function Skills() {
  return (
    <section id="skills" className="py-20 bg-background">
      <div className="container mx-auto px-6">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          <h2 className="text-4xl font-bold text-center mb-4">Mes compétences</h2>
          <div className="w-20 h-px bg-foreground mx-auto mb-12" />
        </motion.div>

        <div className="grid md:grid-cols-2 gap-8">
          {skillCategories.map((category, catIndex) => (
            <motion.div
              key={category.name}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: catIndex * 0.1 }}
            >
              <Card className="bg-card border-foreground/10 h-full">
                <CardHeader>
                  <CardTitle className="text-lg">{category.name}</CardTitle>
                </CardHeader>
                <CardContent>
                  <div className="space-y-6">
                    {category.skills.map((skill, skillIndex) => (
                      <div key={skill.name}>
                        <div className="flex items-center justify-between mb-3">
                          <span className="font-semibold text-foreground">{skill.name}</span>
                          <Badge variant="outline" className="text-xs">
                            {skill.level}%
                          </Badge>
                        </div>
                        <div className="h-2 bg-foreground/10 rounded-sm overflow-hidden">
                          <motion.div
                            initial={{ width: 0 }}
                            whileInView={{ width: `${skill.level}%` }}
                            viewport={{ once: true }}
                            transition={{ delay: catIndex * 0.1 + skillIndex * 0.1, duration: 1 }}
                            className="h-full bg-foreground rounded-sm"
                          />
                        </div>
                      </div>
                    ))}
                  </div>
                </CardContent>
              </Card>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  )
}
