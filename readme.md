# Do you need send your form to some email? Use this library!

formailsender is a simple tool for cases when you have a HTML form and needs that this form be send for a some email.

## HTML email template

![HTML Email template banner](https://nelsoneder.com/src/formSenderAppBanner1.png)

## TAGS Support & config

The name input tag are used as a label. See a example:

```
<input name="Name" value="Jhon">
```

![Input name example](https://nelsoneder.com/src/formSenderAppNameInput.png)

You can use spaces between the words, but don't use _ in the name tags. They will be replaced by blank space.

```
<input name="Your company" value="My company">
```

![Input company example](https://nelsoneder.com/src/formSenderAppYourCompanyInput.png)

And you can use Checkbox input type in your form.

```
<input type="ckeckbox" name="Allow cookies" value="on">
```

![Input cookies example](https://nelsoneder.com/src/formSenderAppAllowCookiesInput.png)

## Methods

### dataIsOk()

That's method will make the $_POST validation according the regex parameter passed in the instance.

### sendEmail()

Send the email with the data passed in the instance, and automatically redirect to the URL passed.

### exitError($errorMessage), exitSuccess($SuccessMessage)

You can redirect to the URL passed with a customizated message.

## formSenderApp()

The class that have to be instancied needs a 7 arguments. See:

```
require_once __DIR__ . '/formSenderApp/app.php';

$formSenderApp = new FormSenderApp(
    'jhonEmail@email.com',                  // The target email
    'myEmail@email.com',                    // The sender email
    'Nelson Eder',                          // The sender name
    'Your form!',                           // The email subject
    "/^[a-zA-ZÀ-ÿ0-9?!\-,.()_@ ]+$/u",      // Regex validator
    25 || ['name', 'email', 'message'],     // Max of inputs OR allowed inputs name
    'https://mybeautifullform.com/form'     // URL to redirect when the email be send
);
```

### Regex Validator

You need to pass a regex for the class make the validation of the $_POST inputs. That's required to prevent as much as possible SQL, XML and SCRIPT Injections.

### Max of inputs OR allowed inputs

If you need filter the inputs that will be received in the class, you can pass a number or a array.

For number, you specify a max quantity of inputs that can be received in the class.

For the array, you specify the allowed input names

### URL to redirect

When have a error or a success in the formAppSender, the class will be redirect automatically for the URL passed.

## Errors redirects

Have a two types of redirects that the class uses.

```
public function exitError($errorMessage);

public function exitSuccess($successMessage);
```

They use the URL param to redirect. The errors are storaged througth $_SESSION global var and you can catch and show they in your form like this way:

```
...
    session_start();
    if(isset($_SESSION['message'])){
        $status = $_SESSION['status'];
        $message = $_SESSION['message'];
        echo "<h1 class='$status'>$message</h1>";
    }
    unset($_SESSION); 
...
```

### How to change the errors messages

Access /formSenderApp/config.php and change the content messages of according the keys.

```
...
public $messages = [
        'POST_LENGTH' => "Erro interno ao enviar formulário (maxLengthPOST)",
        'POST_CHARS' => "Caracteres não permitidos.",
        'POST_UNKNOWN' => "Houve um erro ao enviar o formulário (unknownPOST)",
        'POST_NULL' => "Você tentou enviar um formulário vazio. (POST_NULL)",
        'FORM_ERROR' => "Erro ao enviar formulário (mailFunction)",

        'FORM_SENDED' => "Formulário enviado com sucesso.",
    ];
...
```
