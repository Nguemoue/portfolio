"use client"

import { useEffect, useState } from "react"
import { Moon, Sun } from "lucide-react"
import { Button } from "@/components/ui/button"

type ThemeMode = "light" | "dark"

const STORAGE_KEY = "theme"

export default function ThemeToggle() {
  const [theme, setTheme] = useState<ThemeMode>("light")

  useEffect(() => {
    const stored = typeof window !== "undefined" ? localStorage.getItem(STORAGE_KEY) : null
    const initialTheme = stored === "dark" ? "dark" : "light"
    setTheme(initialTheme)
    document.documentElement.classList.toggle("dark", initialTheme === "dark")
  }, [])

  const toggleTheme = () => {
    const nextTheme: ThemeMode = theme === "dark" ? "light" : "dark"
    setTheme(nextTheme)
    localStorage.setItem(STORAGE_KEY, nextTheme)
    document.documentElement.classList.toggle("dark", nextTheme === "dark")
  }

  return (
    <Button
      variant="outline"
      size="sm"
      onClick={toggleTheme}
      aria-label="Basculer le thème"
      className="gap-2"
      type="button"
    >
      {theme === "dark" ? <Sun className="h-4 w-4" /> : <Moon className="h-4 w-4" />}
      <span>{theme === "dark" ? "Light" : "Dark"}</span>
    </Button>
  )
}
