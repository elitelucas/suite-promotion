module.exports = {
    before: function (browser, done) {
        server = require('../server')(done) // done is a callback that executes when the server is started
    },
    after: function () {
        server.close()
    },
    'test_header'(browser){
        // header element
        browser.url('http://localhost:3099/docs/readme.html').waitForElementVisible('#millery-header')
        browser.expect.element('#millery-header .millery-container').to.be.present
        browser.expect.element('#millery-header .millery-columns > .millery-column:nth-child(1)').to.be.present
        browser.expect.element('#millery-header .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.click("#millery-header .millery-column:nth-child(1) .millery-node:nth-child(1)")
        browser.expect.element('#millery-header .millery-columns > .millery-column:nth-child(2)').to.be.present
    },

    'test_example_1'(browser){
        // testing example #1

        var elementID = "#millery-1";

        browser.execute(function(elementID){
            document.querySelector(elementID).scrollIntoView({block: "center"});
        }, [elementID])

        browser.expect.element(elementID).to.be.present
        browser.expect.element(elementID + " .millery-container").to.be.present
        browser.expect.element(elementID + " .millery-columns .millery-column:nth-child(1) .millery-column-search input").to.be.present

        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "item 6").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 0)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "item 1").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 1)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "item 4").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 1)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "item ").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 5)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 5)

        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(1)")
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.be.present
        browser.click(elementID + " .millery-close-button")
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.not.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(2)")
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.not.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.be.present

    },
    'test_example_2'(browser){
        // testing example #2
        var elementID = "#millery-2";

        browser.execute(function(elementID){
            document.querySelector(elementID).scrollIntoView({block: "center"});
        }, [elementID])

        browser.expect.element(elementID).to.be.present
        browser.expect.element(elementID + " .millery-container").to.be.present
        browser.expect.element(elementID + " .millery-columns .millery-column:nth-child(1) .millery-column-search input").to.be.present

        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "test data 9").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 0)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "test data 1").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 1)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "test data 4").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 1)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "test ").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 7)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 7)

        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(4)")
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.be.present
        browser.click(elementID + " .millery-close-button")
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.not.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(1)")
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.not.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.be.present

    },
    'test_example_3'(browser){
        // testing example #2
        var elementID = "#millery-3";

        browser.execute(function(elementID){
            document.querySelector(elementID).scrollIntoView({block: "center"});
        }, [elementID])

        browser.expect.element(elementID).to.be.present
        browser.expect.element(elementID + " .millery-container").to.be.present
        browser.expect.element(elementID + " .millery-columns .millery-column:nth-child(1) .millery-column-search input").to.be.present

        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "test data 9").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 0)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "test data 1").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 1)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "test data 4").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 1)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "test ").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 7)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 7)

        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(4)")
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.be.present
        browser.click(elementID + " .millery-close-button")
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.not.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(1)")
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.not.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.be.present


    },
    'test_example_4'(browser){
        // testing example #4
        var elementID = "#millery-4";

        browser.execute(function(elementID){
            document.querySelector(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(1)").scrollIntoView({block: "center"});
        }, [elementID])

        browser.expect.element(elementID).to.be.present
        browser.expect.element(elementID + " .millery-container").to.be.present
        browser.expect.element(elementID + " .millery-columns .millery-column:nth-child(1) .millery-column-search input").to.be.present

        browser.setColumnSearch(elementID + " .millery-column:nth-child(1)", "Austria").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 1)
        browser.clickNode(elementID, 1, 1).waitForElementVisible(elementID + " .millery-column:nth-child(2)").assert.visibleCount(elementID + " .millery-column:nth-child(2) .millery-node", 9)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(2)", "Austria").assert.visibleCount(elementID + " .millery-column:nth-child(2) .millery-node", 2)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(2)", "Tyrol").assert.visibleCount(elementID + " .millery-column:nth-child(2) .millery-node", 1)
        browser.clickNode(elementID, 2, 1).waitForElementVisible(elementID + " .millery-column:nth-child(3)").assert.visibleCount(elementID + " .millery-column:nth-child(3) .millery-node", 9)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(3)", "Innsbruck").assert.visibleCount(elementID + " .millery-column:nth-child(3) .millery-node", 2)
        browser.setColumnSearch(elementID + " .millery-column:nth-child(3)", "Innsbruck Stadt").assert.visibleCount(elementID + " .millery-column:nth-child(1) .millery-node", 1)
        browser.clickNode(elementID, 3, 1).waitForElementVisible(elementID + " .millery-column:nth-child(4)").assert.visibleCount(elementID + " .millery-column:nth-child(4) .millery-node", 1)

        .click(elementID + " .millery-back-button").pause(500)
        .click(elementID + " .millery-back-button").pause(500)
        .click(elementID + " .millery-back-button").pause(500)
        .setColumnSearch(elementID + " .millery-column:nth-child(1)", "")

        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(8)")
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.be.present
        browser.click(elementID + " .millery-close-button").pause(500)
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.not.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(1)").pause(500)
        browser.expect.element(elementID + ' .millery-panel-open.millery-container').to.not.be.present
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.be.present


    },
    'test_example_5'(browser){
        // testing example #4
        var elementID = "#millery-5";

        browser.execute(function(elementID){
            document.querySelector(elementID).scrollIntoView({block: "center"});
        }, [elementID])

        browser.expect.element(elementID).to.be.present
        browser.expect.element(elementID + " .millery-container").to.be.present
        browser.expect.element(elementID + " .millery-columns .millery-column:nth-child(1) .millery-column-search input").to.be.present
        browser.clickNode(elementID, 1, 1).pause(500)
        browser.assert.offsetHidden(elementID + " .millery-columns .millery-column:nth-child(1)")
        browser.assert.offsetVisible(elementID + " .millery-columns .millery-column:nth-child(2)")
        browser.clickNode(elementID, 2, 1).pause(500)
        browser.assert.offsetHidden(elementID + " .millery-columns .millery-column:nth-child(1)")
        browser.assert.offsetHidden(elementID + " .millery-columns .millery-column:nth-child(2)")
        browser.assert.offsetVisible(elementID + " .millery-columns .millery-column:nth-child(3)")
    },
    'test_example_6'(browser){
        // testing example #4
        var elementID = "#millery-6";

        browser.execute(function(elementID){
            document.querySelector(elementID).scrollIntoView({block: "center"});
        }, [elementID])

        browser.expect.element(elementID).to.be.present
        browser.expect.element(elementID + " .millery-container").to.be.present
        browser.expect.element(elementID + " .millery-columns .millery-column:nth-child(1) .millery-column-search input").to.be.present

        browser.expect.element(elementID + ' .millery-container .millery-panel').to.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.expect.element(elementID + ' .millery-back-button').to.be.present
        browser.expect.element(elementID + ' .millery-back-button').to.not.be.enabled

        browser.clickNode(elementID, 1, 1).pause(500)
        browser.assert.offsetHidden(elementID + " .millery-columns .millery-column:nth-child(1)")
        browser.assert.offsetVisible(elementID + " .millery-columns .millery-column:nth-child(2)")
        browser.expect.element(elementID + ' .millery-back-button').to.be.enabled
        browser.clickNode(elementID, 2, 1).pause(500)
        browser.assert.offsetHidden(elementID + " .millery-columns .millery-column:nth-child(1)")
        browser.assert.offsetHidden(elementID + " .millery-columns .millery-column:nth-child(2)")
        browser.assert.offsetVisible(elementID + " .millery-columns .millery-column:nth-child(3)")
        browser.expect.element(elementID + ' .millery-back-button').to.be.enabled
        browser.expect.element(elementID + ' .millery-container').to.be.present
        browser.expect.element(elementID + ' .millery-container').to.have.attribute("class").which.not.contains("millery-panel-open")

        browser.click(elementID + " .millery-back-button").pause(500)
        .click(elementID + " .millery-back-button").pause(500)
        .click(elementID + " .millery-back-button").pause(500)
        .setColumnSearch(elementID + " .millery-column:nth-child(1)", "")

        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(4)")
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.have.css("display").which.equals("none")
        browser.assert.containsText(elementID + ' .millery-panel', "Test Data 4")

        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(5)")
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.have.css("display").which.equals("none")
        browser.assert.containsText(elementID + ' .millery-panel', "Test Data 5")
    },
    'test_example_7'(browser){
        // testing example #4
        var elementID = "#millery-7";

        browser.execute(function(elementID){
            document.querySelector(elementID).scrollIntoView({block: "center"});
        }, [elementID])

        browser.expect.element(elementID).to.be.present
        browser.expect.element(elementID + " .millery-container").to.be.present
        browser.expect.element(elementID + " .millery-columns .millery-column:nth-child(1) .millery-column-search input").to.be.present

        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.expect.element(elementID + ' .millery-back-button').to.be.present
        browser.expect.element(elementID + ' .millery-back-button').to.not.be.enabled

        browser.clickNode(elementID, 1, 1).pause(500)
        browser.assert.offsetVisible(elementID + " .millery-columns .millery-column:nth-child(1)")
        browser.assert.offsetVisible(elementID + " .millery-columns .millery-column:nth-child(2)")
        browser.expect.element(elementID + ' .millery-back-button').to.be.enabled
        browser.clickNode(elementID, 2, 1).pause(500)
        browser.assert.offsetVisible(elementID + " .millery-columns .millery-column:nth-child(1)")
        browser.assert.offsetVisible(elementID + " .millery-columns .millery-column:nth-child(2)")
        browser.assert.offsetVisible(elementID + " .millery-columns .millery-column:nth-child(3)")
        browser.expect.element(elementID + ' .millery-back-button').to.be.enabled
        browser.expect.element(elementID + ' .millery-container').to.be.present
        browser.expect.element(elementID + ' .millery-container').to.have.attribute("class").which.not.contains("millery-panel-open")

        browser.click(elementID + " .millery-back-button").pause(500)
        .click(elementID + " .millery-back-button").pause(500)
        .click(elementID + " .millery-back-button").pause(500)
        .setColumnSearch(elementID + " .millery-column:nth-child(1)", "")

        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(4)")
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.be.visible
        browser.expect.element(elementID + ' .millery-container').to.have.attribute("class").which.contains("millery-panel-open")
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.have.css("display").which.equals("block")
        browser.expect.element(elementID + ' .millery-back-button').to.have.css("display").which.not.equals("block")
        browser.assert.containsText(elementID + ' .millery-panel', "Test Data 4")

        browser.click(elementID + " .millery-close-button").pause(500)
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.expect.element(elementID + ' .millery-container').to.have.attribute("class").which.not.contains("millery-panel-open")
        browser.expect.element(elementID + ' .millery-close-button').to.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.have.css("display").which.equals("none")
        browser.expect.element(elementID + ' .millery-back-button').to.have.css("display").which.equals("block")

        browser.click(elementID + " .millery-column:nth-child(1) .millery-node:nth-child(5)")
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.be.visible
        browser.expect.element(elementID + ' .millery-columns > .millery-column:nth-child(2)').to.not.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.have.css("display").which.equals("block")
        browser.expect.element(elementID + ' .millery-back-button').to.have.css("display").which.equals("none")
        browser.assert.containsText(elementID + ' .millery-panel', "Test Data 5")

        // close button should work
        browser.click(elementID + " .millery-close-button").pause(500)
        browser.expect.element(elementID + ' .millery-container .millery-panel').to.not.be.visible
        browser.expect.element(elementID + ' .millery-container').to.have.attribute("class").which.not.contains("millery-panel-open")
        browser.expect.element(elementID + ' .millery-close-button').to.be.present
        browser.expect.element(elementID + ' .millery-close-button').to.have.css("display").which.equals("none")
        browser.expect.element(elementID + ' .millery-back-button').to.have.css("display").which.equals("block")


        browser.end();
    }
};