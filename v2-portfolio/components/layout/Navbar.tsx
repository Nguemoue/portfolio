'use client'

import { useState, useEffect } from 'react'
import Link from 'next/link'
import { motion } from 'framer-motion'
import { Menu, X, Download } from 'lucide-react'
import { Button } from '@/components/ui/button'
import ThemeToggle from '@/components/layout/ThemeToggle'

const navLinks = [
  { href: '#hero', label: 'Accueil' },
  { href: '#about', label: 'À propos' },
  { href: '#education', label: 'Parcours' },
  { href: '#experience', label: 'Expériences' },
  { href: '#projects', label: 'Projets' },
  { href: '#skills', label: 'Compétences' },
  { href: '#contact', label: 'Contact' },
]

export default function Navbar() {
  const [isOpen, setIsOpen] = useState(false)
  const [scrolled, setScrolled] = useState(false)

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 50)
    }
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  return (
    <motion.nav
      initial={{ y: -100 }}
      animate={{ y: 0 }}
      className={`fixed top-0 w-full z-50 transition-all duration-300 ${
        scrolled
          ? 'bg-background/90 backdrop-blur border-b border-foreground/10 shadow-soft'
          : 'bg-background/70 backdrop-blur border-b border-foreground/5'
      }`}
    >
      <div className="container mx-auto px-6 py-4">
        <div className="flex items-center justify-between">
          {/* Logo */}
          <Link href="#hero" className="text-2xl font-bold text-foreground">
            Luc.dev
          </Link>

          {/* Desktop Menu */}
          <div className="hidden lg:flex items-center space-x-8">
            {navLinks.map((link) => (
              <a
                key={link.href}
                href={link.href}
                className="text-sm font-medium text-foreground/70 transition-colors hover:text-foreground"
              >
                {link.label}
              </a>
            ))}
            <div className="flex items-center gap-3">
              <ThemeToggle />
              <Button size="sm">
                <Download className="w-4 h-4 mr-2" />
                CV
              </Button>
            </div>
          </div>

          {/* Mobile Menu Button */}
          <button
            onClick={() => setIsOpen(!isOpen)}
            className="lg:hidden p-2 rounded-sm text-foreground"
          >
            {isOpen ? <X size={24} /> : <Menu size={24} />}
          </button>
        </div>

        {/* Mobile Menu */}
        {isOpen && (
          <motion.div
            initial={{ opacity: 0, height: 0 }}
            animate={{ opacity: 1, height: 'auto' }}
            exit={{ opacity: 0, height: 0 }}
            className="lg:hidden mt-4 pb-4"
          >
            {navLinks.map((link) => (
              <a
                key={link.href}
                href={link.href}
                onClick={() => setIsOpen(false)}
                className="block py-2 text-sm font-medium text-foreground/70 transition-colors hover:text-foreground"
              >
                {link.label}
              </a>
            ))}
            <div className="mt-4 space-y-3">
              <ThemeToggle />
              <Button size="sm" className="w-full">
                <Download className="w-4 h-4 mr-2" />
                Télécharger CV
              </Button>
            </div>
          </motion.div>
        )}
      </div>
    </motion.nav>
  )
}
