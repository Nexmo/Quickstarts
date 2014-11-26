# Quickstart: Recording Audio

The purpose of VoiceXML is to present the caller - or user - with information, and prompt the user for a response. 
Sometimes this is [recognized speech or DTMF digits][input], but it could also be recorded audio. 

Like most VoiceXML documents, it starts with a `<form>`. To keep things simple, we'll place a `<submit>` element 
inside of a `<block>` at the end of the form so it is executed automatically, and the data sent to the `next` URL.

Since we'll be sending an audio file, we'll set the `enctype` to `multipart/form-data` so our server side code can 
handle it just like a file upload from an HTML form.

    <?xml version="1.0" encoding="UTF-8"?>
    <vxml version = "2.1">
        <form>
            <block>
                <submit next="../php/form.php" enctype="multipart/form-data" method="post"/>
            </block>
        </form>
    </vxml>

[*View in Context*](./vxml/form.vxml#L10-L12)

Instead of `<field>` we'll use `<record>` to capture a recording. Like `<field>` the `name` attribute defines how the
recording is referenced in the VoiceXML document, and what name is used when the data is submitted to a URL. Other 
attributes like `beep` and `maxtime` allow you to control the recording process. For more information, talk a look at 
the [W3C documentation on the `<record>` element][record].
 
We can nest a `<prompt>` inside to tell the caller what we want them to record:

    <record name="message" beep="true" maxtime="60s">
        <prompt>Please leave your message after the beep, then press any key.</prompt>
    </record>        

[*View in Context*](./vxml/form.vxml#L4-L6)

At this point, the caller would be prompted to record some audio, and that recording would be submitted to the URL.
However, we can also use the recording in the VoiceXML document itself, so let's play it back to the caller using 
another `<prompt>` along with the the `<value>` element. The expression for `<value>` will be the name of the recording. 

    <block>
        <prompt>Here's what you recorded <value expr="message"/>.</prompt>
    </block>

[*View in Context*](./vxml/form.vxml#L7-L9)

Now our simple VoiceXML document prompts the caller to record a message, and plays it back to them.

Example: [Full VXML](./vxml/form.vxml)

Once the caller has provided a value for `<record>`, the `<block>` element at the enc of the form is  executed, and the 
recording is sent to the defined URL. If VoiceXML is returned by that URL, the call continues. Here's a simple server
side script to save the recording.

Example: [PHP](./php/form.php)

Want to dig a little deeper into VoiceXML? Check out the W3C's documentation of [`<form>`][form], [`<record>`][record], 
and [`<value>`][value]. 

[input]: ../input
[form]: http://www.w3.org/TR/voicexml20/#dml2.1
[record]: http://www.w3.org/TR/voicexml20/#dml2.3.6
[value]: http://www.w3.org/TR/voicexml20/#dml4.1.4