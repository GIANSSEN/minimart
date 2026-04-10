const { app, BrowserWindow, Menu } = require('electron');
const path = require('path');
const { exec } = require('child_process');

let phpServer;

function createWindow() {
    const win = new BrowserWindow({
        width: 1200,
        height: 800,
        title: "CJ's Minimart",
        icon: path.join(__dirname, 'public/images/logo-cjs.png'),
        webPreferences: {
            nodeIntegration: false,
            contextIsolation: true
        }
    });

    // ❌ Remove menu
    Menu.setApplicationMenu(null);
    win.setMenuBarVisibility(false);

    // ✅ Zoom 80%
    win.webContents.setZoomFactor(0.8);

    // Load Laravel
    win.loadURL('http://127.0.0.1:8000');
}

// ✅ Auto start Laravel
function startPHP() {
    const phpPath = "C:\\xampplatest\\php\\php.exe";
    const laravelPath = path.join(__dirname);

    phpServer = exec(`"${phpPath}" artisan serve`, { cwd: laravelPath });

    phpServer.stdout.on('data', data => console.log(data));
    phpServer.stderr.on('data', data => console.error(data));
}

app.whenReady().then(() => {
    startPHP();
    createWindow();
});

app.on('window-all-closed', () => {
    if (phpServer) phpServer.kill();
    if (process.platform !== 'darwin') app.quit();
});