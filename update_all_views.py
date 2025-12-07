#!/usr/bin/env python3
"""
Script untuk mengupdate semua views PTMSI Sumbar dengan UI/UX yang konsisten
"""

import os
import re

# Daftar semua view files
VIEW_FILES = [
    'app/Views/profil.php',
    'app/Views/atlet_pelatih.php',
    'app/Views/klub_pengurus.php',
    'app/Views/event.php',
    'app/Views/pembinaan.php',
    'app/Views/berita.php',
    'app/Views/galeri.php',
    'app/Views/dokumen.php',
    'app/Views/ranking.php',
    'app/Views/layanan_online.php',
    'app/Views/hubungi_kami.php',
]

# CSS yang akan ditambahkan di awal style tag
MODERN_CSS_PREFIX = """    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%);
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        overflow-x: hidden;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 0.8; }
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
"""

# Pattern replacements
REPLACEMENTS = [
    # Update body background
    (r'body\s*\{[^}]*background:\s*#E8F2FF;[^}]*\}', 
     'body { background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%); }'),
    
    # Update page-header gradient
    (r'background:\s*linear-gradient\(135deg,\s*#003366\s+0%,\s*#1E90FF\s+100%\)',
     'background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%)'),
    
    # Update border-radius untuk sections
    (r'border-radius:\s*20px;',
     'border-radius: 30px;'),
    
    # Update box-shadow
    (r'box-shadow:\s*0\s+4px\s+24px\s+rgba\(30,\s*144,\s*255,\s*0\.1\);',
     'box-shadow: 0 10px 40px rgba(30, 144, 255, 0.15);'),
]

def update_view_file(filepath):
    """Update single view file dengan modern CSS"""
    print(f"Updating {filepath}...")
    
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Apply replacements
        for pattern, replacement in REPLACEMENTS:
            content = re.sub(pattern, replacement, content)
        
        # Write back
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        
        print(f"✓ {filepath} updated successfully")
        return True
    except Exception as e:
        print(f"✗ Error updating {filepath}: {e}")
        return False

def main():
    """Main function"""
    print("=" * 60)
    print("PTMSI Sumbar - UI/UX Update Script")
    print("=" * 60)
    print()
    
    success_count = 0
    for view_file in VIEW_FILES:
        if update_view_file(view_file):
            success_count += 1
        print()
    
    print("=" * 60)
    print(f"Update completed: {success_count}/{len(VIEW_FILES)} files updated")
    print("=" * 60)

if __name__ == '__main__':
    main()
