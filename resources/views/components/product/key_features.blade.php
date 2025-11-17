<style>
    /* .card{background:#fff;border-radius:12px;padding:18px;box-shadow:0 6px 18px rgba(20,20,30,0.06);max-width:900px;margin:0 auto} */
    h2{margin:0 0 12px 0;font-size:20px}
    .features-table{width:100%;border-collapse:collapse;margin-top:12px}
    .features-table thead th{ text-align:left;font-size:13px;color:#333;padding:8px 10px;border-bottom:1px solid #eee}
    .features-table tbody td{padding:8px 10px;border-bottom:1px dashed #f0f0f0}
    input[type=text]{width:100%;padding:8px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px}
    .small{font-size:13px;color:#666}
    .btn{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border-radius:8px;border:0;cursor:pointer}
    .btn--add{background:#0ea5a6;color:white}
    .btn--remove{background:transparent;border:1px solid #ef4444;color:#ef4444;padding:6px 8px;border-radius:8px}
    .btn--ghost{background:transparent;border:1px solid #d1d5db;padding:6px 8px;border-radius:8px}
    .actions{display:flex;gap:8px}
    .row-handle{cursor:grab;padding:4px 6px;border-radius:6px;background:#f3f4f6;border:1px solid #e6e7ea}
    .muted{color:#7b8794;font-size:13px}
    .inline{display:inline-block}
    .template{display:none}
    .json-preview{white-space:pre-wrap;background:#0f172a;color:#e6eef8;padding:12px;border-radius:8px;margin-top:12px;font-size:13px}
    .form-actions{display:flex;gap:8px;justify-content:space-between;align-items:center;margin-top:14px}
</style>


<div class="tab-pane fade" id="key-features" role="tabpanel">
    <div class="card-header2 mb-4">
        <h4 class="card-title text-secondary">Product Key Features</h4>
    </div>

    <table class="features-table">
        <thead>
        <tr>
            <th style="width:38px">#</th>
            <th>Feature name</th>
            <th style="width:250px">Feature value (optional)</th>
            <th style="width:120px">Actions</th>
        </tr>
        </thead>
        <tbody id="featuresBody"></tbody>
    </table>

    <!-- Template -->
    <template id="featureRowTemplate">
        <tr class="feature-row">
            <td class="col-index"></td>
            <td><input type="text" name="feature_name[]" class="feature-name form-control" placeholder="e.g. Battery life"></td>
            <td><input type="text" name="feature_value[]" class="feature-value form-control" placeholder="e.g. 10 hours"></td>
            <td><button type="button" class="btn btn--remove btn-remove">Remove</button></td>
        </tr>
    </template>

    <div style="margin-top:12px;display:flex;gap:8px;align-items:center">
        <button type="button" id="addBtn" class="btn btn--add">+ Add feature</button>
        <span class="muted">Maximum suggested: 20</span>
    </div>

    <input type="hidden" name="key_features_json" id="keyFeaturesJson" />

    <script>
        (function(){
          const maxRows = 50;
          const body = document.getElementById('featuresBody');
          const template = document.getElementById('featureRowTemplate');
          const addBtn = document.getElementById('addBtn');
          const jsonInput = document.getElementById('keyFeaturesJson');

          // Pass PHP data to JS
          const oldFeatures = @json(old('feature_name')) || [];
          const oldValues = @json(old('feature_value')) || [];
          const savedFeatures = @json($features ?? []);
          
          // Merge priority: old() > saved DB features
          const initialData = oldFeatures.length 
              ? oldFeatures.map((n, i) => ({
                    feature_name: n, 
                    feature_value: oldValues[i] ?? ''
                }))
              : (savedFeatures.map(f => ({
                    feature_name: f.feature_name,
                    feature_value: f.feature_value
                })) ?? []);

          function createRow(name = '', value = ''){
            const tpl = template.content.cloneNode(true);
            const tr = tpl.querySelector('tr');
            const nameInput = tr.querySelector('.feature-name');
            const valueInput = tr.querySelector('.feature-value');
            const removeBtn = tr.querySelector('.btn-remove');

            nameInput.value = name;
            valueInput.value = value;

            removeBtn.addEventListener('click', () => {
              tr.remove();
              refreshIndices();
              updateSerialized();
            });

            [nameInput, valueInput].forEach(inp => inp.addEventListener('input', updateSerialized));

            return tr;
          }

          function refreshIndices(){
            Array.from(body.querySelectorAll('.feature-row')).forEach((tr, i) => {
              tr.querySelector('.col-index').textContent = i + 1;
            });
          }

          function readFeatures(){
            return Array.from(body.querySelectorAll('.feature-row')).map(tr => ({
              feature_name: tr.querySelector('.feature-name').value.trim(),
              feature_value: tr.querySelector('.feature-value').value.trim() || null
            })).filter(f => f.feature_name);
          }

          function updateSerialized(){
            const json = JSON.stringify(readFeatures(), null, 2);
            jsonInput.value = json;
          }

          function loadInitialRows(){
            if (initialData.length > 0) {
              initialData.forEach(item => body.appendChild(createRow(item.feature_name, item.feature_value)));
            } else {
              body.appendChild(createRow());
            }
            refreshIndices();
            updateSerialized();
          }

          addBtn.addEventListener('click', () => {
            if (body.children.length >= maxRows) return alert('Reached maximum features limit');
            body.appendChild(createRow());
            refreshIndices();
            updateSerialized();
          });

          loadInitialRows();
        })();
    </script>
</div>

