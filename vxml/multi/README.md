# Quickstart: Multiple Items and Forms

If you've already made your way through the [`<field>`][field], [`<record>`][record], and [`<transfer>`][transfer]
quickstarts, you've likely guessed that a single `<form>` can include more than one of those items - and you're 
correct. A single form can prompt the user for spoken input or DTMF keypresses, record audio, transfer the call and 
track the outcome. 

VoiceXML also allows you to have multiple forms in a single VXML document. The `<goto>` element is used to  direct the 
caller to another form, or even another VoiceXML document. 

We can place a `<goto>` in a `<filled>` element, so the caller is directed to another form once all the items in the 
current form have a value. The `next` attribute can be set the name of the next form, or the `expr` can be used to 
determine the name of the form by evaluating an expression. 

For example, if we've asked the caller if they're a new customer, we can direct them to the next form based on their
response:

    <filled>
        <prompt cond="customer_type=='new'">
            Thanks for considering us.
        </prompt>
        <prompt cond="customer_type=='existing'">
            Thanks for being a loyal customer.
        </prompt>
        <goto expr="'#' + customer_type" />
    </filled>
    
[*View in Context*](./vxml/form.vxml#L23-L31)
    
We can control more than just the flow of forms. The `<goto>` element's `nextitem` or `expritem` attributes can be used 
to control the flow inside a form, setting the next form item to visit. A `<filled>` element nested inside a form 
executes when all the items have values, but a `<filled>` element inside of a form item executes once that item has a 
value - regardless of the other items in the form. We can use this to execute a `<goto>` after a specific item has been 
set.

Now that we've directed an exsisting customer to the correct form, let's use the value of the first field to determine 
the next form item to visit. 
 
    <field name="menu">
        <prompt>Press 1 or say support, press 2 or say review to leave a customer testimonial.</prompt>
        <grammar xml:lang="en-US" root = "TOPLEVEL" mode="voice" >
            <rule id="TOPLEVEL" scope="public">
                <one-of>
                    <item> support </item>
                    <item> review </item>
                </one-of>
            </rule>
        </grammar>
        <grammar xml:lang="en-US" root = "TOPLEVEL" mode="dtmf" >
            <rule id="TOPLEVEL" scope="public">
                <one-of>
                    <item> 1 <tag> out.menu="support"; </tag> </item>
                    <item> 2 <tag> out.menu="review"; </tag> </item>
                </one-of>
            </rule>
        </grammar>
        <filled>
            <goto expritem="menu" />
        </filled>
    </field>

[*View in Context*](./vxml/form.vxml#L42-L63)

Before the form is considered `<filled>` all items must have a value. An `expr` attribute can be used pre-set a value. 
This allows `<goto>` to direct the flow to the correct item, without the form automatically executing the item that 
should be ignored before reach the `<submit>`. 

    <transfer name="support" dest="tel:+4402035141909" bridge="true" expr="false">
        <prompt>Connecting you to support.</prompt>
    </transfer>
    <record name="review" beep="true" expr="false">
        <prompt>Glad you want to leave a review, tell us what you think after the beep.</prompt>
        <filled>
            <prompt>Thanks!</prompt>
        </filled>
    </record>
    <filled>
        <submit next="http://requestb.in/16dfd8l1" enctype="multipart/form-data" method="post"/>
    </filled>

[*View in Context*](./vxml/form.vxml#L64-L75)

First the item without a value is executed, presenting the caller with a choice of support or review, `<goto>` directs
the caller to the item the picked, then - since all items have a value - `<filled>` submits the data to the web server.

Example: [Full VXML](./vxml/form.vxml)

The POST data would contain the result of the transfer or audio of the recording - depending on which item the caller 
chose. The value of the other item will be whatever the `expr` set it to.

Example: [PHP](./php/form.php)

Want to dig a little deeper into VoiceXML? Check out the W3C's documentation of [`<goto>`][goto], [`<filled>`][filled],  
and [how forms are processed][fia].

[field]: ../input
[record]: ../record
[transfer]: ../transfer
[filled]: http://www.w3.org/TR/voicexml20/#dml2.4
[fia]: http://www.w3.org/TR/voicexml20/#dml2.1.1