import type { Metadata } from "next";
import { Poppins } from "next/font/google"
import "./globals.css";
import Navbar from "@/components/layout/Navbar"
import Footer from "@/components/layout/Footer"
import FloatingActions from "@/components/layout/FloatingActions"

const poppins = Poppins({
  weight: ["300", "400", "500", "600", "700"],
  subsets: ["latin"],
  variable: "--font-poppins",
})

export const metadata: Metadata = {
  title: "Luc Nguemoue - Développeur Web Full Stack | Portfolio & CV",
  description: "Développeur web passionné spécialisé en Laravel, JavaScript et Intelligence Artificielle. Découvrez mes projets, compétences et expériences.",
  keywords: ["développeur web", "Laravel", "JavaScript", "PHP", "Intelligence Artificielle", "portfolio", "CV", "Cameroun", "Yaoundé", "développeur full stack"],
  authors: [{ name: "Luc Nguemoue" }],
  openGraph: {
    type: "website",
    title: "Luc Nguemoue - Développeur Web Full Stack | Portfolio",
    description: "Développeur web passionné spécialisé en Laravel, JavaScript et IA. Découvrez mes projets et compétences.",
    url: "https://luc-dev.site/",
    siteName: "Luc Nguemoue Portfolio",
    locale: "fr_FR",
  },
  twitter: {
    card: "summary_large_image",
    title: "Luc Nguemoue - Développeur Web Full Stack",
    description: "Développeur web passionné spécialisé en Laravel, JavaScript et IA.",
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="fr" className={`${poppins.variable}`} suppressHydrationWarning>
      <body className="font-sans antialiased bg-background text-foreground">
        <Navbar />
        <main>{children}</main>
        <Footer />
        <FloatingActions />
      </body>
    </html>
  );
}
