import { Github, Linkedin, Mail, Phone, MapPin } from 'lucide-react'

const socialLinks = [
  {
    icon: Linkedin,
    href: 'https://www.linkedin.com/in/nguemoue',
    label: 'LinkedIn',
  },
  {
    icon: Github,
    href: 'https://www.github.com/Nguemoue',
    label: 'GitHub',
  },
  {
    icon: Mail,
    href: 'mailto:lucchuala@gmail.com',
    label: 'Email',
  },
]

export default function Footer() {
  return (
    <footer className="bg-background text-foreground py-12 border-t border-foreground/10">
      <div className="container mx-auto px-6">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {/* About */}
          <div>
            <h3 className="text-xl font-bold mb-4">Luc Nguemoue</h3>
            <p className="text-foreground/70 text-sm leading-relaxed">
              Développeur Full Stack passionné par l'innovation et la création
              de solutions web modernes et performantes.
            </p>
          </div>

          {/* Contact */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Contact</h3>
            <div className="space-y-2 text-sm text-foreground/70">
              <div className="flex items-center gap-2">
                <Phone className="w-4 h-4" />
                <span>+237 699 568 073</span>
              </div>
              <div className="flex items-center gap-2">
                <Mail className="w-4 h-4" />
                <span>lucchuala@gmail.com</span>
              </div>
              <div className="flex items-center gap-2">
                <MapPin className="w-4 h-4" />
                <span>Yaoundé, Cameroun</span>
              </div>
            </div>
          </div>

          {/* Social */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Suivez-moi</h3>
            <div className="flex flex-wrap gap-4">
              {socialLinks.map((link) => (
                <a
                  key={link.label}
                  href={link.href}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="w-10 h-10 rounded-sm border border-foreground/20 flex items-center justify-center hover:bg-foreground hover:text-background transition-colors"
                  aria-label={link.label}
                >
                  <link.icon className="w-5 h-5" />
                </a>
              ))}
            </div>
          </div>
        </div>

        <div className="border-t border-foreground/10 mt-8 pt-8 text-center text-sm text-foreground/60">
          <p>© {new Date().getFullYear()} Luc Nguemoue. Tous droits réservés.</p>
        </div>
      </div>
    </footer>
  )
}
