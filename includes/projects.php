<?php
$projects = [
    [
        'title' => 'Rock Paper Scissor',
        'description' => 'Création d\'un jeu Pierre-Papier-Ciseaux avec une interface interactive.',
        'icon' => '<div class="skill-card">
            <i class="fa-solid fa-hand-back-fist"></i>
            <i class="fa-solid fa-hand"></i>
            <i class="fa-solid fa-hand-scissors"></i>
        </div>',
        'technologies' => ['HTML', 'CSS', 'JavaScript'],
        'link' => 'project/rock_paper_scissor/rock_paper_scissor.php'
    ],
    [
        'title' => 'Site de gestion de stage',
        'description' => 'Espace d\'échange entre étudiants et entreprises pour la gestion des stages.',
        'icon' => '<div class="skill-card">
            <i class="fa-solid fa-marker"></i>
        </div>',
        'technologies' => ['HTML', 'CSS', 'JavaScript', 'SQL', 'PHP'],
        'link' => 'project/mon-site-main/index.php'
    ],
    [
        'title' => 'Cv maker',
        'description' => 'Application web permettant de créer et personnaliser son CV en ligne.',
        'icon' => '<div class="skill-card">
            <i class="fa-solid fa-file"></i>
        </div>',
        'technologies' => ['HTML', 'CSS', 'JavaScript', 'PHP'],
        'link' => 'project/Cv_Maker/Cv_Maker_Page.php'
    ],
    [
        'title' => 'PokeGeo',
        'description' => 'Application de trade card game avec système de collection et d\'échange.',
        'icon' => '<div class="skill-card">
            <i class="fa-solid fa-file"></i>
        </div>',
        'technologies' => ['HTML', 'CSS', 'JavaScript', 'PHP'],
        'link' => 'project/Jeux_carte/index.php'
    ]
];

foreach ($projects as $project) {
    ?>
    <div class="project-card">
        <?php echo $project['icon']; ?>
        <div class="project-content">
            <h3 class="project-title"><?php echo $project['title']; ?></h3>
            <p class="project-description"><?php echo $project['description']; ?></p>
            <div class="project-technologies">
                <?php foreach ($project['technologies'] as $tech) { ?>
                    <span class="tech-tag"><?php echo $tech; ?></span>
                <?php } ?>
            </div>
            <div class="project-links">
                <a href="<?php echo $project['link']; ?>" class="project-link" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    Voir le projet
                </a>
            </div>
        </div>
    </div>
    <?php
}
?> 