const fs = require('fs');
const path = require('path');
const zlib = require('zlib');
const { execSync } = require('child_process');

// Simple script to extract text from xlsx (zip) using command line unzip tools if available
// Or just try to read sharedStrings.xml
const file = process.argv[2];
const tempDir = path.join(__dirname, 'temp_excel');

try {
    if (!fs.existsSync(tempDir)) fs.mkdirSync(tempDir);
    
    // Use powershell to unzip
    execSync(`powershell -Command "Expand-Archive -Path '${file}' -DestinationPath '${tempDir}' -Force"`);
    
    const sharedStringsPath = path.join(tempDir, 'xl', 'sharedStrings.xml');
    if (fs.existsSync(sharedStringsPath)) {
        const content = fs.readFileSync(sharedStringsPath, 'utf8');
        // Simple regex to extract <t> content
        const matches = content.match(/<t>(.*?)<\/t>/g);
        if (matches) {
            matches.forEach(m => {
                console.log(m.replace(/<\/?t>/g, ''));
            });
        }
    } else {
        console.log("No shared strings found.");
    }
} catch (err) {
    console.error("Error:", err.message);
} finally {
    // Cleanup
    // fs.rmSync(tempDir, { recursive: true, force: true });
}
