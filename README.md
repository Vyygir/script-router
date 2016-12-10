<a href="https://travis-ci.org/Vyygir/script-router">
	<img src="https://travis-ci.org/Vyygir/script-router.svg?branch=master)" align="right">
</a>

# Script Router #

This plugin has been developed so that you're able to load specific scripts into your website
based on whereabouts the user actually is. So, for example, if the user were on
`http://yourwebsite.com/about` then four "routes" would be determined that point to scripts in
your theme:

- `page.js`
- `page/{id}.js`
- `page/{slug}.js`
- `page/{template}.js`

Where `{id}`, `{slug}`, and `{template}` are the relevant ID, slug, and template for your page.

There's also a script that's always loaded into the build called `default.js` for anything that
you do actually need to run all the time.

Any scripts that the plugin looks for are located under the currently active theme's root in a
directory called `js/routes`. If a script doesn't exist, then nothing will be loaded.

What this enables you to do is have separate scripts running on a "per-page" basis that accounts
for WordPress' non-standard routing. And the only thing you have to do is create your scripts,
name them appropriately, and this plugin will handle the loading of them for you.

## Development ##

I can't promise or guarantee regular maintenance and updating of the plugin, so if you spot a
route that hasn't been added, or tweak one that isn't picking up correctly, then please feel free
to fork the repository, make your change, and then create a pull request back. Whilst I'm not
regularly maintaining the code, that doesn't mean that I won't pick up pull requests.

I will only accept commits that follow the same code standards as my own - so make sure that you
set your IDE to your tabs! The code is fairly straightforward though, so picking it up and
keeping it consistent really shouldn't be too hard.

## Issues ##

Similarly to development, whilst I'm not actively maintaining the code on a regular basis, I
will happily respond to and deal with issues that are reported. So if you spot something that's
not quite right and you'd like it be fixed, or don't have the technical know-how to do it by
yourself, then go and create an issue and I'll look into it.

If you're creating an issue, do remember do provide a decent description of your issue in a
coherent and sensible way, otherwise I'm not going to be able to help you and you'll be left in
the lurch.

### Changelog ###

| Version | Date       | Description |
| ------- | :--------: | ----------- |
| 0.1.0   | 10/12/2016 | The plugin was created |