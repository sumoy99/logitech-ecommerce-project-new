const fs = require("fs");
const path = require("path");

// যেই ফোল্ডারে তোমার Blade ফাইল আছে (চাইলে resources/views/custom-path ও দিতে পারো)
const bladeDir = path.join(__dirname, "resources", "views");

// Regex to match input/select/textarea name attributes
const nameRegex = /name="([^"]+)"/g;

let allNames = [];

// Recursive function — সাবফোল্ডারসহ সব ফাইল চেক করবে
function scanBladeFiles(dir) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const fullPath = path.join(dir, file);
        const stat = fs.statSync(fullPath);

        if (stat.isDirectory()) {
            scanBladeFiles(fullPath);
        } else if (file.endsWith(".blade.php")) {
            const content = fs.readFileSync(fullPath, "utf8");
            let match;
            while ((match = nameRegex.exec(content)) !== null) {
                allNames.push({
                    name: match[1],
                    file: file,
                    line: content.substr(0, match.index).split("\n").length
                });
            }
        }
    }
}

scanBladeFiles(bladeDir);

// এখন ডুপ্লিকেট খুঁজে বের করা হচ্ছে
const duplicates = allNames
    .map(item => item.name)
    .filter((name, index, arr) => arr.indexOf(name) !== index);

if (duplicates.length === 0) {
    console.log("✅ No duplicate input names found!");
} else {
    console.log("⚠️ Duplicate input names found:\n");
    duplicates.forEach(dup => {
        console.log(`🔁 ${dup}`);
        allNames
            .filter(item => item.name === dup)
            .forEach(item => console.log(`   ↳ ${item.file} (line ${item.line})`));
    });
}
