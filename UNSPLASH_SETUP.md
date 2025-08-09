# Configuration de l'API Unsplash pour les Images

## 🖼️ **Comment obtenir des vraies images de maisons marocaines**

### **1. Obtenir une clé API Unsplash (Gratuit)**

1. Va sur [unsplash.com/developers](https://unsplash.com/developers)
2. Crée un compte gratuit
3. Crée une nouvelle application
4. Copie ta clé d'accès (Access Key)

### **2. Configuration dans Laravel**

Ajoute ta clé dans le fichier `.env` :

```env
UNSPLASH_ACCESS_KEY=ta_cle_api_ici
```

### **3. Mise à jour du contrôleur**

Remplace `YOUR_UNSPLASH_ACCESS_KEY` dans `app/Http/Controllers/ImageController.php` :

```php
private $unsplashAccessKey = env('UNSPLASH_ACCESS_KEY', 'YOUR_UNSPLASH_ACCESS_KEY');
```

### **4. Fonctionnalités disponibles**

#### **Images Dynamiques via API**
- **Route:** `/api/images/moroccan`
- **Méthode:** GET
- **Retour:** Images réelles de maisons marocaines depuis Unsplash

#### **Propriétés Configurées**
- **Route:** `/api/properties/moroccan`
- **Méthode:** GET
- **Retour:** Liste des propriétés marocaines avec images

### **5. Types d'Images Disponibles**

#### **Riad Traditionnel**
- **Recherche:** "moroccan riad interior"
- **Localisation:** Marrakech, Fès
- **Prix:** €120-250/nuit

#### **Villa Moderne**
- **Recherche:** "moroccan villa pool"
- **Localisation:** Agadir, Essaouira
- **Prix:** €160-180/nuit

#### **Maison Traditionnelle**
- **Recherche:** "marrakech traditional house"
- **Localisation:** Chefchaouen, Tanger
- **Prix:** €95-130/nuit

#### **Appartement Moderne**
- **Recherche:** "moroccan apartment"
- **Localisation:** Casablanca
- **Prix:** €85/nuit

### **6. Système de Cache**

Les images sont mises en cache pendant 1 heure pour :
- ✅ **Réduire les appels API**
- ✅ **Améliorer les performances**
- ✅ **Éviter les limites de taux**

### **7. Images de Fallback**

Si l'API échoue, le système utilise des images de fallback :
- **Haute qualité** depuis Unsplash
- **Optimisées** pour le web
- **Toujours disponibles**

### **8. Utilisation dans le Frontend**

```javascript
// Récupérer des images dynamiques
fetch('/api/images/moroccan')
  .then(response => response.json())
  .then(images => {
    // Utiliser les images réelles
    console.log(images);
  });

// Récupérer les propriétés configurées
fetch('/api/properties/moroccan')
  .then(response => response.json())
  .then(properties => {
    // Afficher les propriétés avec vraies images
    console.log(properties);
  });
```

### **9. Avantages de cette Solution**

✅ **Images Réelles** - Vraies photos de maisons marocaines
✅ **API Dynamique** - Images mises à jour automatiquement
✅ **Cache Intelligent** - Performance optimisée
✅ **Fallback Sécurisé** - Toujours des images disponibles
✅ **Configuration Flexible** - Facile à modifier
✅ **Gratuit** - API Unsplash gratuite

### **10. Prochaines Étapes**

1. **Obtiens ta clé API** Unsplash
2. **Configure ton fichier .env**
3. **Teste les routes API**
4. **Profite des vraies images !**

---

**Note:** L'API Unsplash est gratuite avec une limite de 5000 requêtes par heure, largement suffisant pour un site de démonstration. 