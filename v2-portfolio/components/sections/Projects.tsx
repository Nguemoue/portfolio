'use client'

import { useState } from 'react'
import { motion } from 'framer-motion'
import { ExternalLink, Github } from 'lucide-react'
import { Button } from '@/components/ui/button'
import { Card, CardHeader, CardTitle, CardContent, CardFooter } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Separator } from '@/components/ui/separator'

const categories = ['Tous', 'Enterprise', 'Personnel']

const projects = [
  {
    id: 1,
    title: 'Système de Gestion',
    category: 'Enterprise',
    description: 'Application web complète pour la gestion des ressources d\'entreprise',
    image: '/assets/projects/project1.jpg',
    technologies: ['Laravel', 'Vue.js', 'MySQL'],
    github: 'https://github.com/nguemoue',
    demo: 'https://demo.com',
  },
  {
    id: 2,
    title: 'Portfolio Dynamique',
    category: 'Personnel',
    description: 'Portfolio personnel avec système d\'administration',
    image: '/assets/projects/project2.jpg',
    technologies: ['Next.js', 'TailwindCSS', 'PHP'],
    github: 'https://github.com/nguemoue',
    demo: 'https://luc-dev.site',
  },
  // Ajoutez plus de projets ici
]

export default function Projects() {
  const [activeCategory, setActiveCategory] = useState('Tous')

  const filteredProjects =
    activeCategory === 'Tous'
      ? projects
      : projects.filter((p) => p.category === activeCategory)

  return (
    <section id="projects" className="py-20 bg-background">
      <div className="container mx-auto px-6">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          <h2 className="text-4xl font-bold text-center mb-4">Mes projets</h2>
          <div className="w-20 h-px bg-foreground mx-auto mb-8" />
          <p className="text-center text-foreground/70 max-w-2xl mx-auto mb-12">
            Découvrez une sélection de mes réalisations, allant de projets personnels 
            à des solutions professionnelles pour entreprises.
          </p>
        </motion.div>

        {/* Filter */}
        <div className="flex flex-wrap justify-center gap-4 mb-12">
          {categories.map((category) => (
            <Button
              key={category}
              variant={activeCategory === category ? 'default' : 'outline'}
              onClick={() => setActiveCategory(category)}
              className="min-w-[120px]"
            >
              {category}
            </Button>
          ))}
        </div>

        {/* Projects Grid */}
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          {filteredProjects.map((project, index) => (
            <motion.div
              key={project.id}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: index * 0.1 }}
              whileHover={{ y: -10 }}
            >
              <Card className="overflow-hidden hover:shadow-soft-lg transition-all h-full flex flex-col bg-card border-foreground/10">
                {/* Image */}
                <div className="relative h-48 bg-foreground/5 overflow-hidden flex items-center justify-center">
                  <div className="text-3xl text-foreground/40">PROJECT</div>
                </div>

                {/* Content */}
                <CardHeader className="pb-3">
                  <div className="flex items-start justify-between gap-2 mb-2">
                    <CardTitle className="text-lg">{project.title}</CardTitle>
                    <Badge variant="outline" className="whitespace-nowrap text-xs">
                      {project.category}
                    </Badge>
                  </div>
                </CardHeader>

                <CardContent className="flex-grow pb-4">
                  <p className="text-sm text-foreground/70 mb-4">{project.description}</p>

                  {/* Technologies */}
                  <div className="flex flex-wrap gap-2">
                    {project.technologies.map((tech) => (
                      <Badge key={tech} variant="outline" className="text-xs">
                        {tech}
                      </Badge>
                    ))}
                  </div>
                </CardContent>

                <Separator className="my-0" />

                {/* Links */}
                <CardFooter className="gap-3 pt-4">
                  <Button size="sm" variant="outline" className="flex-1" asChild>
                    <a href={project.github} target="_blank" rel="noopener noreferrer">
                      <Github className="w-4 h-4 mr-2" />
                      Code
                    </a>
                  </Button>
                  <Button size="sm" className="flex-1" asChild>
                    <a href={project.demo} target="_blank" rel="noopener noreferrer">
                      <ExternalLink className="w-4 h-4 mr-2" />
                      Démo
                    </a>
                  </Button>
                </CardFooter>
              </Card>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  )
}
