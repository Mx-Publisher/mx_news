#Simple News Manager Module v. 1.0.3

MXP Module
- for MXP Core 2.8.x / 3.0.x

Note: This module currently supports standalone/internal and phpBB2 mode only (with MXP 3.0.x)

Author [Credits]
Jon Ohlsson [Jon Ohlsson, Mohd Basri, wGEric, PHP Arena, pafileDB, CRLin]
Designed for MX-Publisher by [Jon Ohlsson] <a href="http://mxpcms.sourceforge.net" target="_blank">The MX-Publisher Development Team</a>.

Description
The Simple News Manager module is an addon product for the MX-Publisher Core.

Features
Simple News Manager, with a latest news block.

[x] News archieves are "per block"
[x] Custom fields
[x] Ratings & comments
[x] Admin PM/email notification


Module Blocks

    Main
    This is the main module block.
    Lists
    This is the portal block for showing "latest", "most popular" etc.

Module Setup

0. <a href="#install">Installation/Upgrade Instructions</a>

I. <a href="#Manual">Users Hints/Manual</a>

II. <a href="#themes">Additional styles</a>

III. <a href="#languages">Additional languages</a>

DEMO

DOWNLOAD

<a href="#top">Back to Top</a>

<a name="install">
0. Installation/Upgrade Instructions
To install this module, follow these instructions. If you encounter any problems during install, visit the support forum or online docs.

INSTALLATION

    [1] Download the Module Package and upload. Copy the folder 'mx_module' into your 'mxbbroot\modules\' folder on your web server.
    [2] MXP ACP -> Management -> Modules Setup.
    [3] Use the pull down menu and choose 'mx_module' [where mx_module is the name of the module to install].
    [4] Press the Install Module button.
    [5] Refresh Page, and the Module Control Panel menus will be added to the MXP ACP left column.
    6) If you have followed the instructions correctly your new module, and associated blocks should be availible to add to your pages.

UPGRADE
Upgrading MXP Core does NOT upgrade Core Modules. Modules (both Core and Addons/3rd party) must be upgraded using the MXP Administration Control Panel (MXP ACP).

    [1] Download the Module Package and upload. Copy the folder 'mx_module' into your 'mxbbroot\modules\' folder on your web server. Be sure not to overwrite module data folders, eg for file uploads, images etc (if supported by the module).
    [2] MXP ACP -> Management -> Modules Setup.
    [3] Open the Module 'Upgrade' tab and click 'Upgrade'.
    [4] Study the Upgrade log, and save (if present) any error messages, for later support.
    [5] Done.

Note: When "uninstalling", only the module itself is removed from the db. You will be asked specifically it you also want to delete all related module data (like actual downloads, weblinks, photos, articles etc) - to avoid disaster.

<a href="#top">Back to Top</a>

<a name="Manual">
I. Users Hints/Manual
This module provides a set of new MXP Blocks, to be used on MXP Pages. However, you first need to create instances of these blocks yourself, using the MXP adminCP - blockCP. Once done, you can add these blocks to MXP Pages, using the MXP adminCP - pageCP.

1) General settings. In the AdminCP - Module all module settings are defined.

<a href="#top">Back to Top</a>

<a name="themes">
II. Additional Styles
This module is compatible with any standard theme/style.

<a href="#top">Back to Top</a>

<a name="languages">
III. Additional Languages
First check to see if your language is already translated.

Translated languages are available at mxpcms.sourceforge.net.

If exists, download and install in the modules/mx_modulename/language folder. If not, duplicate (copy and paste) any included language file, rename to match your language, translate using any texteditor, save and upload.

<a href="#top">Back to Top</a>

/mxBB Team[/list]
