# Mobile App with Phonegap

### Memory Store, Local Storage and Web Sql
This is a fully functional employee directory application with PhoneGap - v1.1

#### Features
- Different local data storage strategies.
- PhoneGap APIs:  Geolocation, Contacts, and Camera.
- Handle specific mobile problems such as touch events, scrolling, styling, page transitions, etc.
- Build an application using a single page architecture and HTML templates.

#### Explore the different data store
- memory-store.js (MemoryStore)
- ls-store.js (LocalStorageStore)
- websql-store.js (WebSqlStore)

#### Test the application with different persistence mechanisms

To change the local persistence mechanism for the application:

- In js/main.js: Instantiate the specific store in the initialize() function of the app object: MemoryStore, LocalStorageStore, or WebSqlStore.

