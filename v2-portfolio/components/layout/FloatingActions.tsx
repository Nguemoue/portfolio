"use client"

import { ArrowUp, MessageCircle } from "lucide-react"

const actions = [
  {
    href: "https://wa.me/237699568073",
    label: "WhatsApp",
    icon: MessageCircle,
  },
  {
    href: "#hero",
    label: "Retour en haut",
    icon: ArrowUp,
  },
]

export default function FloatingActions() {
  return (
    <div className="fixed bottom-6 right-6 z-50 flex flex-col gap-3">
      {actions.map((action) => (
        <a
          key={action.label}
          href={action.href}
          aria-label={action.label}
          className="h-11 w-11 rounded-sm border border-foreground/20 bg-background text-foreground shadow-soft hover:bg-foreground hover:text-background transition-colors flex items-center justify-center"
          target={action.href.startsWith("http") ? "_blank" : undefined}
          rel={action.href.startsWith("http") ? "noopener noreferrer" : undefined}
        >
          <action.icon className="h-5 w-5" />
        </a>
      ))}
    </div>
  )
}
