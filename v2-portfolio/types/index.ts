// Types pour le portfolio

export interface Project {
  id: number;
  title: string;
  description: string;
  longDescription?: string;
  image: string;
  technologies: string[];
  category: 'entreprise' | 'personnel';
  projectUrl?: string;
  githubUrl?: string;
  isFeatured: boolean;
  isActive: boolean;
  orderPosition: number;
  createdAt: string;
}

export interface Experience {
  id: number;
  jobTitle: string;
  company: string;
  companyUrl?: string;
  location: string;
  startDate: string;
  endDate?: string;
  isCurrent: boolean;
  description: string;
  technologies: string[];
  isActive: boolean;
  orderPosition: number;
}

export interface Education {
  id: number;
  degree: string;
  institution: string;
  location: string;
  startDate: string;
  endDate: string;
  description?: string;
  image?: string;
  isActive: boolean;
  orderPosition: number;
}

export interface Skill {
  id: number;
  name: string;
  category: string;
  proficiency: 'débutant' | 'intermédiaire' | 'avancé' | 'expert';
  icon?: string;
  isActive: boolean;
  orderPosition: number;
}

export interface Certification {
  id: number;
  title: string;
  issuingOrganization: string;
  credentialId?: string;
  credentialUrl?: string;
  issueDate: string;
  expirationDate?: string;
  description?: string;
  image?: string;
  isActive: boolean;
  orderPosition: number;
}

export interface CV {
  id: number;
  title: string;
  description?: string;
  filePath: string;
  fileSize: number;
  language: 'fr' | 'en';
  isPrimary: boolean;
  downloadCount: number;
  isActive: boolean;
}

export interface PersonalInfo {
  id: number;
  name: string;
  title: string;
  description: string;
  email: string;
  phone?: string;
  whatsapp?: string;
  location: string;
  country: string;
  profileImage?: string;
  linkedinUrl?: string;
  githubUrl?: string;
}

export interface BlogPost {
  id: string;
  title: string;
  slug: string;
  excerpt: string;
  content: string;
  coverImage: string;
  publishedAt: string;
  author: string;
  tags: string[];
  readTime: number;
}

export interface Testimonial {
  id: number;
  name: string;
  position: string;
  company: string;
  content: string;
  image?: string;
  rating: number;
}

export interface ContactMessage {
  name: string;
  email: string;
  subject: string;
  message: string;
}

// Catégories
export type ProjectCategory = 'all' | 'entreprise' | 'personnel';
export type SkillCategory = 'Backend' | 'Frontend' | 'DevOps' | 'Mobile' | 'Database' | 'Tools' | 'Other';
export type ProficiencyLevel = 'débutant' | 'intermédiaire' | 'avancé' | 'expert';
