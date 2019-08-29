export default class RecordSorter {
    static sortByDate(records = []) {
        return records.sort((a, b) => {
            return moment(b.datetime) - moment(a.datetime)
        })
    }

    static sortByStringField(records = [], field) {
        return records.sort((a, b) => {
            return a[field].toLowerCase().localeCompare(b[field].toLowerCase())
        })
    }

    static sortByObjectNameField(records = [], field={}) {
        let nullRecords = []
        return records.filter(record => {
            if (record[field] === null) nullRecords.push(record)
            return record[field] !== null
        }).sort((a, b) => {
            return a[field].name.toLowerCase().localeCompare(b[field].name.toLowerCase())
        }).concat(nullRecords)
    }
    /**
     * Create arrays for first letter pass as char "E" and char "S", after sort them for last record number segment, this is the number of sequence, ej: E019-001 --> 001 and finally concat the two arrays
     * @param {array} records
     * @param {string} char
     * @param {string} char
     * @param {string} prop
     */
    static sortByCharAndNumber(records = [], char = 'E', char2 = 'S', prop = 'number') {
        let charRecords = []
        let char2Records = []
       
        charRecords = records.filter(record => {
            return record[prop].split('-')[0].charAt(0) === char
        })

        char2Records =  records.filter(record => {
            return record[prop].split('-')[0].charAt(0) === char2
        })

        const sortArray = function(records = []) {
            return records.sort((a, b) => {
                return (
                    Number(a[prop].split('-')[1]) -
                    Number(b[prop].split('-')[1])
                )
            })
        }
        charRecords = sortArray(charRecords)
        char2Records = sortArray(char2Records)

        return charRecords.concat(char2Records)
    }
}
