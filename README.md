# Cre8iv FormBuilder

Forms are often a pain to implement. Unfortunately, most sites need them, so we at **[Cre8iv Click](https://cre8iv.click)** decided to try and create a Kirby plugin to make dealing with forms easier on the developer. The FormBuilder plugin tries to help by doing 3 things:

### 1. Easy, Customised Form Creation in The Panel
The plugin provides a pre-made interface that allows the end-user to create and configure their custom form directly in the Panel. This allows the visual creation of many different types of forms - from standard 'Contact Us', through to long questionnaires.

### 2. Auto-creation of Form HTML in Templates
Based on your panel configuration, FormBuilder can generate the form's HTML code automatically for you, injecting it into your template or snippet with a single line of code.

### 3. Built-in Form Processing
A big part of the headache in handling forms is processing the submitted responses. FormBuilder provides ready-made functions to submit responses via email, and to display received responses in the Kirby Panel, too - no coding needed!

****

## Requirements & Installation
FormBuilder requires the **[Kirby Builder Plugin](https://github.com/TimOetting/kirby-builder)** for its panel interface - make sure you install it, before installing FormBuilder.

### Manual Download
You can simply download and copy this repository to `/site/plugins/formbuilder`.

### Git Submodule
You can add FormBuilder to your project as a git submodule, with this command:

```
git submodule add https://gitlab.com/cre8ivclick/formbuilder.git site/plugins/formbuilder
```

### Composer
If you use composer, you can quickly add FormBuilder to your project like this:
```
composer require cre8ivclick/formbuilder
```


****

## Documentation
For complete instructions on how to install, configure and use FormBuilder in your Kirby site, please refer to the **[Wiki area](https://gitlab.com/cre8ivclick/formbuilder/wikis/home)** of this project.


****


## Contributing
Please use the 'Issues' page of this project to report any bugs you find, and post ideas and feature requests.

We have tried to keep the code in the plugin reasonably simple, organised and well-commented. Feel free to fork this project, and send enhancements and bug fixes via merge requests. Please be aware, that we aim to keep the plugin _simple_ and _easy to maintain_.

## To-Do
- [ ] better submission log interface
- [ ] export submissions to CSV file
- [ ] storage of submissions into backend database

## License

FormBuilder is released under the MIT License - see the 'LICENSE.md' file included in this repository for full license text.

## Credits

The Cre8iv FormBuilder is developed by [Cre8iv Click](https://cre8iv.click), but would not have been possible to create without the work of others:

* FormBuilder's panel interface requires Tim Ötting's excellent [Kirby Builder Plugin](https://github.com/TimOetting/kirby-builder)
* the amazing [Sonja Broda](https://github.com/texnixe) helped troubleshoot ajax form submission and handling, through her professional and friendly advice in the [Kirby Forum ](https://forum.getkirby.com)
* our panel submission logging was based off some code examples from the very skilled [Pedro Borges](https://github.com/pedroborges)
