<div class="modal-body">
    <form action="ajouter_bien.php" method="POST" enctype="multipart/form-data" id="formAjoutBien">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre*</label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                </div>
                <div class="mb-3">
                    <label for="ville" class="form-label">Ville*</label>
                    <input type="text" class="form-control" id="ville" name="ville" required>
                </div>
                <div class="mb-3">
                    <label for="arrondissement" class="form-label">Arrondissement</label>
                    <input type="text" class="form-control" id="arrondissement" name="arrondissement">
                </div>
                <div class="mb-3">
                    <label for="surface" class="form-label">Surface (m²)*</label>
                    <input type="number" class="form-control" id="surface" name="surface" required min="1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix (€)*</label>
                    <input type="number" class="form-control" id="prix" name="prix" required min="0">
                </div>
                <div class="mb-3">
                    <label for="pieces" class="form-label">Pièces*</label>
                    <input type="number" class="form-control" id="pieces" name="pieces" required min="1">
                </div>
                <div class="mb-3">
                    <label for="chambres" class="form-label">Chambres*</label>
                    <input type="number" class="form-control" id="chambres" name="chambres" required min="0">
                </div>
                <div class="mb-3">
                    <label for="sdb" class="form-label">Salles de bain*</label>
                    <input type="number" class="form-control" id="sdb" name="sdb" required min="0">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut*</label>
                    <select class="form-control" id="statut" name="statut" required>
                        <option value="normal">Normal</option>
                        <option value="nouveau">Nouveau</option>
                        <option value="coup_de_coeur">Coup de cœur</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="type" class="form-label">Type*</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="appartement">Appartement</option>
                        <option value="maison">Maison</option>
                        <option value="luxe">Luxe</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Images*</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" required>
            <div class="form-text">Sélectionnez une ou plusieurs images</div>
        </div>

        <div class="mb-3">
            <label for="videos" class="form-label">Vidéos</label>
            <input type="file" class="form-control" id="videos" name="videos[]" multiple accept="video/*">
            <div class="form-text">Format MP4 recommandé</div>
        </div>

        <div class="mb-3">
            <label for="visite_virtuelle_url" class="form-label">Visite Virtuelle (URL)</label>
            <input type="url" class="form-control" id="visite_virtuelle_url" name="visite_virtuelle_url" placeholder="https://...">
        </div>

        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" id="submitAjoutBien">Ajouter</button>
        </div>
    </form>
</div>