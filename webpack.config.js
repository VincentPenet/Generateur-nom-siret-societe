const Encore = require('@symfony/webpack-encore');

// Configurez manuellement l'environnement d'exécution s'il n'est pas encore configuré par la commande "encore".
// C'est utile lorsque vous utilisez des outils qui reposent sur le fichier webpack.config.js.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // répertoire où les assets compilés seront stockés
    .setOutputPath('public/build/')
    // chemin public utilisé par le serveur Web pour accéder au chemin de sortie
    .setPublicPath('/build')
    // nécessaire uniquement pour le déploiement de CDN ou de sous-répertoires
    //.setManifestKeyPrefix('build/')

    /*
     * CONFIG ENTRÉE
     *
     * Chaque entrée se traduira par un fichier JavaScript (par exemple, app.js)
     * et un fichier CSS (par exemple app.css) si votre JavaScript importe du CSS.
     */

    /** JS **/
    .addEntry('app', './assets/app.js')
    .addEntry('copy', './assets/js/copy.js')
    /** END JS **/

    /** CSS **/
    .addEntry('global', './assets/css/themes/global.css')
    .addEntry('styleNAT', './assets/css/themes/styleNAT.css')
    /** END CSS **/


    // active le pont Symfony UX Stimulus (utilisé dans assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // Lorsqu'il est activé, Webpack "divise" vos fichiers en plus petits morceaux pour une meilleure optimisation.
    .splitEntryChunks()

    // Nécessite une balise de script supplémentaire pour runtime.js
    // mais, vous voulez probablement cela, sauf si vous créez une application d'une seule page.
    // Vous devez ajouter {{ asset('build/runtime.js') }} au début du block JS dans votre application twig
    .enableSingleRuntimeChunk()

    /*
     * CONFIGURATION DES FONCTIONS
     *
     *Activez et configurez les autres fonctionnalités ci-dessous. Pour une liste complète des fonctionnalités, voir :
     *
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // Active les noms de fichiers hachés (par exemple, app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // Active @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

// Active le support Sass/SCSS
//.enableSassLoader()

// décommenter si vous utilisez TypeScript
//.enableTypeScriptLoader()

// décommenter si vous utilisez React
//.enableReactPreset()

// décommentez pour obtenir les attributs d'intégrité="..." sur votre script et les balises de lien
// exige WebpackEncoreBundle 1.4 ou version supérieure
//.enableIntegrityHashes(Encore.isProduction())

// décommentez si vous rencontrez des problèmes avec un plugin jQuery
//.autoProvidejQuery()

module.exports = Encore.getWebpackConfig();
