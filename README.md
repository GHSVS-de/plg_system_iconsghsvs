# plg_system_iconsghsvs
Joomla system plugin. Embed SVG icons into the HTML by replacing expressions/placeholders such as `{svg{bi/arrow-down}}` with the corresponding icon (arrow-down.svg). Expressions/placeholders can be used nearly everywhere.

## Releases
https://github.com/GHSVS-de/plg_system_iconsghsvs/releases

## Requirements
Installed `Joomla package/file IconsGhsvs` from https://github.com/GHSVS-de/pkg_file_iconsghsvs/releases

## Examples

A) Enter this placeholder in an editor, e.g. of an article:

```
{svg{bi/share}}
```

and the plugin will replace it in frontend HTML with (example shortened):

```
<span aria-hidden="true" class="svgSpan svg-lg">
 <svg viewBox="0 0 16 16" class="bi bi-share" fill="currentColor"
  xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
  <path d="M13.601 2.326A7.854... ></path>
 </svg>
</span>
```

B) Enter this placeholder in an editor, e.g. of an article:

```
{svg{bi/share}class="bg-warning"}
```

and the plugin will replace it in frontend HTML with (example shortened):

```
<span aria-hidden="true" class="svgSpan svg-lg bg-warning">
 <svg viewBox="0 0 16 16" class="bi bi-share" fill="currentColor"
  xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
  <path d="M13.601 2.326A7.854... ></path>
 </svg>
</span>
```

C) Enter this placeholder in an editor, e.g. of an article:

```
{svg{bi/share}class="bg-warning" href="https://ghsvs.de"}
```

and the plugin will replace it in frontend HTML with (example shortened):

```
<a href="https://ghsvs.de">
 <span aria-hidden="true" class="svgSpan svg-lg bg-warning">
  <svg viewBox="0 0 16 16" class="bi bi-share" fill="currentColor"
   xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
   <path d="M13.601 2.326A7.854... ></path>
  </svg>
 </span>
</a>
```

## Placeholders overview
Find more `{svg{bi/...}}` placeholders here: https://ghsvs.de/media/iconsghsvs/icons-overview.html

----------------------

# My personal build procedure (WSL 1, Debian, Win 10)

- Prepare/adapt `./package.json`.
- `cd /mnt/z/git-kram/plg_system_iconsghsvs`

## node/npm updates/installation
- `npm run updateCheck` or (faster) `npm outdated`
- `npm run update` (if needed) or (faster) `npm update --save-dev`
- `npm install` (if needed)

## Build installable ZIP package
- `node build.js`
- New, installable ZIP is in `./dist` afterwards.
- All packed files for this ZIP can be seen in `./package`. **But only if you disable deletion of this folder at the end of `build.js`**.s

#### For Joomla update server
- Use/See `dist/release_no-changelog.txt` as basic release text.
- Create new release with new tag.
- Extracts(!) of the update XML for update servers are in `./dist` as well. Check for necessary additions! Then copy/paste.
