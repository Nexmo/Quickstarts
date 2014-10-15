# Quickstart: Prompting for Input

The purpose of VoiceXML is to present the caller - or user - with information, and prompt the user for a response. The 
simplest example of this is a single form, with a single field. Like HTML, VoiceXML handles user input using forms, 
however, instead of `<input>` like HTML, VoiceXML forms generally contain one or more `<field>` elements.
 
Like HTML forms, the data of a VoiceXML `<form>` can be submitted to a URL. The `<submit>` element can be nested 
in a `<catch>` element or other similar event related elements, but for now we'll just place the `<submit>` element 
inside of a simple `<block>` element so it is executed automatically.

    <?xml version="1.0" encoding="UTF-8"?>
    <vxml version = "2.1">
        <form>
            <block>
                <submit next="form.php" method="post"/>
            </block>
        </form>
    </vxml>

[*View in Context*](./vxml/form.vxml#L23-L25)


Each `<field>` has a `name` attribute which defines how that field is accessed in the VoiceXML, and what name is used
when the data is submitted to a URL.

Inside the `<field>` you can nest a `<prompt>`, which - as you'd expect - prompts the user to provide a value for the 
given field.

    <field name="department">
        <prompt>Press 1 or say sales, press 2 or say support.</prompt>
    </field>            

[*View in Context*](./vxml/form.vxml#L4-L5)

How does the user provide that data? User input is captured using VoiceXML's `<grammar>` element. The most basic
grammar is simple speech recognition. While we won't explore it now, each `<grammar>` must have a `root` rule defined
as an attribute, and a matching child `<rule>`. We'll define our grammar as being `<one-of>` a set of values, and 
provide all the valid `<items>` as children. We'll also explicitly set the `<grammar>` `mode` attribute to `voice`, 
limiting this to speech recognition only.

    <grammar xml:lang="en-US" root = "TOPLEVEL" mode="voice" >
        <rule id="TOPLEVEL" scope="public">
            <one-of>
                <item> sales </item>
                <item> support </item>
            </one-of>
        </rule>
    </grammar>

[*View in Context*](./vxml/form.vxml#L6-L13)

But what about those handy - likely now virtual - buttons a user can press? A `<grammar>` element is also use to capture
them. To support both speech and DTMF (dialed digits), we'll add another `<grammar>` element, this time using a `mode` 
of `dtmf`. Like the last one, we'll define a set of `<items>` the user should be selecting `<one-of>`. However, we'll 
add a `<tag>` element to control the value of the selection. Should a user press 1, we don't want to send that 1 to our
URL. Instead we want to send what that digit represents, and we can define that by setting the property of the `out` 
object matching the name of our `<field>`.

    <grammar xml:lang="en-US" root = "TOPLEVEL" mode="dtmf" >
        <rule id="TOPLEVEL" scope="public">
            <one-of>
                <item> 1 <tag> out.department="sales"; </tag> </item>
                <item> 2 <tag> out.department="support"; </tag> </item>
            </one-of>
        </rule>
    </grammar>

[*View in Context*](./vxml/form.vxml#L14-L21)

Example: [Full VXML](./vxml/form.vxml)

Now, once the user has provided a value for `<field>`, the `<block>` element is executed, and the data is sent to the 
defined URL. That data can be evaluated and used to generate the next VoiceXML document. 

Example: [PHP](./php/form.php)

Want to dig a little deeper into VoiceXML? Check out the W3C's documentation of [`<form>`], [`<field>`], and 
[`<submit>`]. 
