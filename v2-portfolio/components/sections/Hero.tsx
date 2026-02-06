"use client"

import { motion } from "framer-motion"
import { ArrowRight } from "lucide-react"
import { Button } from "@/components/ui/button"

const highlights = [
  "Laravel & Next.js",
  "Interfaces épurées",
  "Performance & qualité",
  "Expériences produit",
]

export default function Hero() {
  return (
    <section id="hero" className="relative bg-background">
      <div className="absolute inset-0 bg-grid" aria-hidden="true" />
      <div className="container relative z-10">
        <div className="min-h-screen pt-32 pb-20 grid lg:grid-cols-[1.1fr_0.9fr] gap-12 items-center">
          <motion.div
            initial={{ opacity: 0, y: 24 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
          >
            <span className="inline-flex items-center border border-foreground/20 text-foreground/70 rounded-sm px-3 py-1 text-xs uppercase tracking-[0.3em]">
              Portfolio
            </span>
            <h1 className="mt-6 text-4xl md:text-6xl font-semibold tracking-tight text-foreground">
              NGUEMOUE LUC
              <span className="mt-3 block text-lg md:text-2xl font-normal text-foreground/70">
                Senior Web Developper
              </span>
            </h1>
            <p className="mt-6 text-lg text-foreground/70 max-w-xl">
              Développeur Full Stack orienté produit. Je conçois des expériences
              web soignées, rapides et simples à maintenir — avec une exécution
              claire, lisible et professionnelle.
            </p>
            <div className="mt-8 flex flex-wrap gap-3">
              <Button size="lg" asChild>
                <a href="#projects">
                  Voir les projets
                  <ArrowRight className="ml-2 h-4 w-4" />
                </a>
              </Button>
              <Button size="lg" variant="outline" asChild>
                <a href="#contact">Me contacter</a>
              </Button>
            </div>
            <div className="mt-10 grid grid-cols-2 gap-4 text-sm text-foreground/70">
              {highlights.map((item) => (
                <div key={item} className="flex items-center gap-2">
                  <span className="h-1.5 w-1.5 rounded-sm bg-foreground" />
                  {item}
                </div>
              ))}
            </div>
          </motion.div>

          <motion.div
            initial={{ opacity: 0, y: 24 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.1 }}
            className="justify-self-end w-full"
          >
            <div className="w-full max-w-lg ml-auto">
              <div className="aspect-[4/3] bg-foreground/5 rounded-md">
                <img
                  src="/assets/img/profile.jpeg"
                  alt="Luc Nguemoue"
                  className="h-full w-full object-contain grayscale rounded-md"
                />
              </div>
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  )
}
