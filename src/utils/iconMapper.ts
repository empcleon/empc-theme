// Icon mapper - converts string names to Lucide React components
import {
    Zap,
    Users,
    Shield,
    Clock,
    Heart,
    Target,
    CheckCircle,
    Star,
    ArrowRight
} from 'lucide-react';

export const iconMap: Record<string, any> = {
    Zap,
    Users,
    Shield,
    Clock,
    Heart,
    Target,
    CheckCircle,
    Star,
    ArrowRight
};

export function getIconComponent(iconName: string) {
    return iconMap[iconName] || CheckCircle; // Fallback to CheckCircle
}
