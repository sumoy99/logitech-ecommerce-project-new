<style>
    #color_value {
      border-radius: 0.25rem;
      transition: all 0.2s;
      display: inline-block;
      padding: 5px 10px;
      font-family: monospace;
      border: 1px solid #ddd;
      background-color: #ff0000;
      color: #000;
    }
  </style>
  
  <form action="{{ route('superadmin.color.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Color Name</label>
      <input type="text" name="name" class="form-control" placeholder="e.g., Red" required>
    </div>
  
    <div class="mb-3">
      <label for="hex_code" class="form-label">Color Code</label>
      <div class="d-flex align-items-center gap-3">
        <input type="color" name="hex_code" id="hex_code" class="form-control form-control-color" value="#ff0000" required>
        <span id="color_value">#ff0000</span>
      </div>
      <div class="form-text">Pick a color to see the code</div>
    </div>
  
    <div class="form-check form-switch mb-3">
      <input class="form-check-input" type="checkbox" name="status" id="status" checked>
      <label class="form-check-label" for="status">Active</label>
    </div>
  
    <button type="submit" class="btn btn-primary w-100">Add Color</button>
  </form>
  
  <script>
    function initColorPreview() {
      const colorInput = document.getElementById('hex_code');
      const colorValue = document.getElementById('color_value');
      const colorNameInput = document.querySelector('input[name="name"]');
  
      if (colorInput && colorValue && colorNameInput) {
        function updateColorPreview(hex) {
          colorValue.textContent = hex;
          colorValue.style.backgroundColor = hex;
          colorValue.style.color = getContrastYIQ(hex);
          colorInput.style.backgroundColor = hex;
          colorInput.style.color = getContrastYIQ(hex);
  
          // Auto-fill color name only if name is empty or previously auto-filled
          if (!colorNameInput.dataset.userTyped || colorNameInput.dataset.userTyped === "false") {
            const matchedName = getColorName(hex);
            colorNameInput.value = matchedName;
          }
        }
  
        updateColorPreview(colorInput.value);
  
        colorInput.addEventListener('input', function () {
          updateColorPreview(this.value);
        });
  
        // Detect manual typing to avoid overwriting
        colorNameInput.addEventListener('input', function () {
          this.dataset.userTyped = "true";
        });
      }
  
      function getContrastYIQ(hexcolor) {
        hexcolor = hexcolor.replace("#", "");
        const r = parseInt(hexcolor.substr(0, 2), 16);
        const g = parseInt(hexcolor.substr(2, 2), 16);
        const b = parseInt(hexcolor.substr(4, 2), 16);
        const yiq = (r * 299 + g * 587 + b * 114) / 1000;
        return yiq >= 128 ? "#000000" : "#ffffff";
      }
  
      function getColorName(hex) {
        const colorNames = {
          "#000000": "Black",
          "#ffffff": "White",
          "#ff0000": "Red",
          "#00ff00": "Lime",
          "#0000ff": "Blue",
          "#ffff00": "Yellow",
          "#00ffff": "Cyan",
          "#ff00ff": "Magenta",
          "#808080": "Gray",
          "#800000": "Maroon",
          "#008000": "Green",
          "#000080": "Navy",
          "#ffa500": "Orange",
          "#a52a2a": "Brown",
          "#ffc0cb": "Pink",
          "#800080": "Purple"
        };
        return colorNames[hex.toLowerCase()] || "Custom Color";
      }
    }
  </script>
  
  