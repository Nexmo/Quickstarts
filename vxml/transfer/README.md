# VoiceXML: Transferring a Call

Along with prompting a caller for information, VoiceXML also allows you transfer a ongoing call to an different number 
or SIP address. And like [`<field>`][field] and [`<record>`][record] the `<transfer>` element behaves like other 
`<form>` elements, the name of the element holding the end result of the transfer. That result could be `noanswer`, 
`busy`, or a [few other outcomes][results].

The destination is the `dest` attribute of the transfer element, prefixed with either `sip:` or `tel:` depending on the 
destination type. You'll also need to set the `bridge` attribute to true. This allows the VoiceXML document to result
after the transfer ends, as well as allow grammar to be active during the call. 

You can set the timeout for the transfer - the time given the other party to answer - using `connecttimeout`, and 
`maxtime` can be used to set how long the two calls can connected. 

Like other `<form>` elements, `<prompt>` can be nested to notify the user of the transfer, and `<grammar>` can be used
to allow the transfer to be ended with a DTMF or a spoken command.

[Example](./vxml/transfer.vxml#L4-L13)

Once the transfer is complete, we can use the result value to drive some logic, and let the caller know what happened 
(assuming they didn't end the transfer by hanging up). When nested in a `<form>`, the `<filled>` element is executed 
once all the child items have a value. Adding a set of `<if>`, `<elseif>`, and `<else>` elements allows us to change 
the flow based on the transfer's value.

[Example](./vxml/transfer.vxml#L14-L26)

Along with the outcome of the transfer, there are a few 'shadow variables' providing things like call duration, and how 
the call was ended. The shadow variable are accessed by appending `$` to the element's name, then using dot notation to 
reference the specific variable. Instead of using prompts to notify the user of the transfer status, `<submit>` could 
be used to send that data to a server for logging.
 
Example: [Full VXML](./vxml/transfer.vxml)

Want to dig a little deeper into VoiceXML? Check out the W3C's documentation of [`<transfer>`][transfer], 
[`<filled>`][filled], [`<if>`][if], and [shadow variables][shadow].

[field]: ../input
[record]: ../record
[transfer]: http://www.w3.org/TR/voicexml20/#dml2.3.7
[filled]: http://www.w3.org/TR/voicexml20/#dml2.4
[if]: http://www.w3.org/TR/voicexml20/#dml5.3.4
[shadow]: http://www.w3.org/TR/voicexml20/#dml2.3
[results]: http://www.w3.org/TR/voicexml20/#dml2.3.7.2 