# 📋 Backlog - Évolution Todo vers gestion avancée (sous-tâches, dépendances, etc.)

## 0. Point de départ (Todo classique)
- [ ] DB : table `tasks(id, list_id, title, status ENUM('todo','doing','done'), due_at, created_at)`.
- [ ] API : endpoints CRUD basiques (`POST /tasks`, `GET /tasks`, `PATCH /tasks/:id`, `DELETE /tasks/:id`).
- [ ] UI : affichage en liste simple, ajout/édition/suppression de tâches.
- [ ] Authentification : système d’utilisateur minimal (ex: email + magic link).
- [ ] Base de styles : thème clair/sombre, responsive mobile/desktop.

---

## 1. Sous-tâches et hiérarchie
- [ ] DB : ajouter `parent_id` (nullable) et `order_index` (NUMERIC) + index `(list_id, parent_id, order_index)`.
- [ ] API : CRUD pour sous-tâches (`POST /tasks/:id/subtasks`, support `parent_id` et `order_index` dans `PATCH`).
- [ ] Logique : propagation du statut parent ↔ enfants.
- [ ] UI : indentation (Tab/Shift+Tab), compteur `x/y` de complétion, drag & drop hiérarchique.

## 2. Métadonnées de tâches
- [ ] DB : ajouter `priority` (SMALLINT), `estimate_minutes` (INT), `labels` et table de jonction `task_labels`.
- [ ] API : gestion des labels (CRUD), attribution/retrait sur tâche.
- [ ] UI : affichage badges priorité, labels, estimation.
- [ ] Filtres : vues **Aujourd’hui**, **En retard**, **Haute priorité**.

## 3. Rappels et échéances
- [ ] DB : `remind_at` (TIMESTAMPTZ) ou `remind_offset_minutes` (INT).
- [ ] API : créer/éditer rappels sur tâches.
- [ ] Cron : envoi e-mails/push (digest quotidien recommandé).
- [ ] UI : config des rappels dans l’éditeur de tâche.

## 4. Récurrence
- [ ] DB : champ `rrule` (TEXT, RFC5545).
- [ ] API : création/modif de tâches récurrentes.
- [ ] Cron : génération d’occurrences (fenêtre glissante 30–60 jours).
- [ ] Logique : mode “après achèvement” pour régénérer.

## 5. Dépendances entre tâches
- [ ] DB : table `task_dependencies(blocked_id, blocker_id)` avec contrainte d’unicité.
- [ ] API : ajout/suppression de dépendances, prévention des cycles.
- [ ] UI : badge “Blocked by #123” + tri intelligent des tâches “Ready”.

## 6. Vues avancées
- [ ] Vues **Kanban** : colonnes par `status`, drag & drop pour changer de statut.
- [ ] Vue **Calendrier** : affichage par `due_at`, possibilité de déplacer pour changer la date.
- [ ] Option : vue **Timeline/Gantt** pour projets.

## 7. Collaboration et partage
- [ ] DB : tables `projects` et `project_members`.
- [ ] API : gestion des membres (`owner`, `editor`, `viewer`).
- [ ] UI : partage lien lecture seule, affichage avatars des membres actifs.
- [ ] Notifications : mention, assignation, due bientôt.

---

## 📌 Notes techniques
- Stocker toutes les dates en UTC, convertir côté client.
- Utiliser `order_index` décimal pour réordonner sans réécrire toute la liste.
- Gérer la complétion parent → enfants et inversement via triggers ou logique backend.
- Récurrence : préférer dupliquer la tâche plutôt que réouvrir la même.
- Optimiser avec index `(status, due_at)` et `(parent_id)`.
